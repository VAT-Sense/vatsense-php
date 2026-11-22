<?php

namespace Tests;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Vatsense\Core\Util;
use Vatsense\Webhooks\Webhook;
use Vatsense\Webhooks\WebhookSignatureException;

/**
 * Batches, consultation_optional, confirmation_number and webhook signatures
 * (late November 2026), sent through a mock transport.
 *
 * @internal
 *
 * @coversNothing
 */
class BatchesAndWebhooksTest extends TestCase
{
    private const SECRET = 'whsec_test_secret';

    private const PAYLOAD = '{"id":"evt_1","type":"batch.completed","created":1793365200,"livemode":true,"data":{"object":{"object":"batch"}}}';

    /** @var array<string,mixed> */
    private array $batch = [
        'object' => 'batch',
        'id' => '01JM0000000000000000000000',
        'number' => 4,
        'status' => 'processing',
        'livemode' => true,
        'rows' => ['total' => 2, 'to_check' => 2, 'done' => 1],
        'quote' => null,
    ];

    private function response(string $body, string $type = 'application/json'): ResponseInterface
    {
        return Psr17FactoryDiscovery::findResponseFactory()
            ->createResponse()
            ->withStatus(200)
            ->withHeader('Content-Type', $type)
            ->withBody(Psr17FactoryDiscovery::findStreamFactory()->createStream($body))
        ;
    }

    /**
     * @return array{\Vatsense\Client, Client}
     */
    private function client(mixed $data): array
    {
        $transporter = new Client;
        $transporter->setDefaultResponse(
            $this->response(json_encode(['success' => true, 'code' => 200, 'data' => $data], flags: Util::JSON_ENCODE_FLAGS) ?: '')
        );

        $client = new \Vatsense\Client(
            baseUrl: 'http://localhost',
            username: 'user',
            password: 'key',
            requestOptions: ['transporter' => $transporter],
        );

        return [$client, $transporter];
    }

    public function testCreateSendsBodyAndIdempotencyKey(): void
    {
        [$client, $transporter] = $this->client($this->batch);

        $batch = $client->batches->create(
            rows: [['vatNumber' => 'GB288305674', 'companyName' => 'Weio Ltd']],
            shortfall: 'pause',
            autoContinue: false,
            idempotencyKey: 'nov-1',
        );

        $request = $transporter->getRequests()[0];
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('/batches', $request->getUri()->getPath());
        $this->assertSame('nov-1', $request->getHeaderLine('Idempotency-Key'));
        $this->assertSame(
            ['rows' => [['vat_number' => 'GB288305674', 'company_name' => 'Weio Ltd']], 'shortfall' => 'pause', 'auto_continue' => false],
            json_decode((string) $request->getBody(), true),
        );
        $this->assertSame('01JM0000000000000000000000', $batch->data->id);
        $this->assertSame(1, $batch->data->rows?->done);
    }

    public function testEveryActionCallsItsPath(): void
    {
        $id = '01JM0000000000000000000000';
        [$client, $transporter] = $this->client($this->batch);

        $client->batches->retrieve($id);
        $client->batches->start($id, shortfall: 'overage');
        $client->batches->pause($id);
        $client->batches->continue($id, shortfall: 'overage');
        $client->batches->complete($id);

        $calls = array_map(
            static fn ($request) => $request->getMethod().' '.$request->getUri()->getPath(),
            $transporter->getRequests(),
        );
        $this->assertSame([
            "GET /batches/{$id}",
            "POST /batches/{$id}/start",
            "POST /batches/{$id}/pause",
            "POST /batches/{$id}/continue",
            "POST /batches/{$id}/complete",
        ], $calls);
        $this->assertSame(['shortfall' => 'overage'], json_decode((string) $transporter->getRequests()[1]->getBody(), true));
    }

    public function testListAndResults(): void
    {
        [$client, $transporter] = $this->client(['data' => [$this->batch], 'page' => 2, 'limit' => 10, 'total' => 11, 'has_more' => false]);
        $page = $client->batches->list(page: 2, limit: 10);
        parse_str($transporter->getRequests()[0]->getUri()->getQuery(), $query);
        $this->assertSame(['page' => '2', 'limit' => '10'], $query);
        $this->assertSame(11, $page->data->total);
        $this->assertSame('01JM0000000000000000000000', $page->data->data[0]->id);

        [$client, $transporter] = $this->client(['data' => [['row' => 1, 'vat_number' => 'GB288305674', 'result' => 'valid', 'confirmation_number' => null]], 'has_more' => true, 'next_after' => 1]);
        $results = $client->batches->results('01JM0000000000000000000000', after: 0, limit: 1);
        $this->assertTrue($results->data->hasMore);
        $this->assertSame(1, $results->data->nextAfter);
        $this->assertSame('valid', $results->data->data[0]->result);
    }

    public function testDeleteAndCsv(): void
    {
        [$client] = $this->client(['object' => 'batch', 'id' => '01JM0000000000000000000000', 'deleted' => true]);
        $this->assertTrue($client->batches->delete('01JM0000000000000000000000')->data->deleted);

        $transporter = new Client;
        $transporter->setDefaultResponse($this->response("row,vat_number\n1,GB288305674\n", 'text/csv; charset=UTF-8'));
        $client = new \Vatsense\Client(baseUrl: 'http://localhost', username: 'user', password: 'key', requestOptions: ['transporter' => $transporter]);
        $this->assertSame("row,vat_number\n1,GB288305674\n", $client->batches->resultsCsv('01JM0000000000000000000000'));
    }

    public function testValidateConsultationOptionalAndConfirmationNumber(): void
    {
        [$client, $transporter] = $this->client(['valid' => true, 'confirmation_number' => 'VSC-ABC']);

        $result = $client->validate->check(vatNumber: 'FR40303265045', requesterVatNumber: 'GB288305674', consultationOptional: true);

        parse_str($transporter->getRequests()[0]->getUri()->getQuery(), $query);
        $this->assertContains($query['consultation_optional'] ?? null, ['1', 'true']);
        $this->assertSame('VSC-ABC', $result->data?->confirmationNumber);
    }

    private static function sign(int $timestamp, string $body, string $secret = self::SECRET): string
    {
        return hash_hmac('sha256', $timestamp.'.'.$body, $secret);
    }

    public function testWebhookAcceptsAGoodEvent(): void
    {
        $header = 't=1793365200,v1='.self::sign(1793365200, self::PAYLOAD);
        $event = Webhook::constructEvent(self::PAYLOAD, $header, self::SECRET, now: 1793365260);
        $this->assertSame('batch.completed', $event['type']);
    }

    public function testWebhookAcceptsTheOldSecretDuringARoll(): void
    {
        $header = 't=1793365200,v1='.self::sign(1793365200, self::PAYLOAD, 'whsec_new').',v1='.self::sign(1793365200, self::PAYLOAD);
        Webhook::verifySignature(self::PAYLOAD, $header, self::SECRET, now: 1793365200);
        $this->addToAssertionCount(1);
    }

    /**
     * @return list<array{string|null, int}>
     */
    public static function badHeaders(): array
    {
        return [
            [null, 1793365200],
            ['', 1793365200],
            ['v1=abc', 1793365200],
            ['t=1793365200', 1793365200],
            ['t=soon,v1=abc', 1793365200],
            ['t=1793365200,v1='.self::sign(1793365200, self::PAYLOAD, 'whsec_other'), 1793365200],
            ['t=1793365200,v1='.self::sign(1793365200, self::PAYLOAD), 1793365200 + 301],
        ];
    }

    #[\PHPUnit\Framework\Attributes\DataProvider('badHeaders')]
    public function testWebhookRefusesBadEvents(?string $header, int $now): void
    {
        $this->expectException(WebhookSignatureException::class);
        Webhook::verifySignature(self::PAYLOAD, $header, self::SECRET, now: $now);
    }

    public function testWebhookRefusesAChangedBody(): void
    {
        $this->expectException(WebhookSignatureException::class);
        $header = 't=1793365200,v1='.self::sign(1793365200, self::PAYLOAD);
        Webhook::verifySignature(str_replace('true', 'false', self::PAYLOAD), $header, self::SECRET, now: 1793365200);
    }
}
