<?php

namespace Tests;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;
use Vatsense\Core\Util;

/**
 * The API additions of November 2026, sent through a mock transport.
 *
 * @internal
 *
 * @coversNothing
 */
class ApiAdditionsTest extends TestCase
{
    /**
     * @param array<string,mixed> $answer
     *
     * @return array{\Vatsense\Client, Client}
     */
    private function client(array $answer = ['success' => true, 'code' => 200, 'data' => []]): array
    {
        $transporter = new Client;
        $transporter->setDefaultResponse(
            Psr17FactoryDiscovery::findResponseFactory()
                ->createResponse()
                ->withStatus(200)
                ->withHeader('Content-Type', 'application/json')
                ->withBody(Psr17FactoryDiscovery::findStreamFactory()->createStream(json_encode($answer, flags: Util::JSON_ENCODE_FLAGS) ?: ''))
        );

        $client = new \Vatsense\Client(
            baseUrl: 'http://localhost',
            username: 'user',
            password: 'key',
            requestOptions: ['transporter' => $transporter],
        );

        return [$client, $transporter];
    }

    public function testInvoiceCreateSendsIdempotencyKeyAsHeader(): void
    {
        [$client, $transporter] = $this->client();

        $client->invoice->create(
            business: ['name' => 'VAT Sense', 'address' => 'London', 'vatNumber' => 'GB12345678'],
            currencyCode: 'GBP',
            date: '2026-11-05',
            items: [['item' => 'Plan', 'priceEach' => 10, 'quantity' => 1, 'vatRate' => 20]],
            taxPoint: '2026-11-05',
            type: 'refund',
            originalInvoiceID: 'in5aeae457cda2a',
            idempotencyKey: 'order-203',
        );

        $request = $transporter->getRequests()[0];
        $this->assertSame('order-203', $request->getHeaderLine('Idempotency-Key'));

        $body = json_decode((string) $request->getBody(), true);
        $this->assertIsArray($body);
        $this->assertSame('in5aeae457cda2a', $body['original_invoice_id']);
        $this->assertArrayNotHasKey('idempotencyKey', $body);
    }

    public function testInvoiceCreateWithoutKeySendsNoHeader(): void
    {
        [$client, $transporter] = $this->client();

        $client->invoice->create(
            business: ['name' => 'VAT Sense', 'address' => 'London', 'vatNumber' => 'GB12345678'],
            currencyCode: 'GBP',
            date: '2026-11-05',
            items: [['item' => 'Plan', 'priceEach' => 10, 'quantity' => 1, 'vatRate' => 20]],
            taxPoint: '2026-11-05',
        );

        $this->assertFalse($transporter->getRequests()[0]->hasHeader('Idempotency-Key'));
    }

    public function testValidateSendsMatchParametersAndReadsMatch(): void
    {
        [$client, $transporter] = $this->client([
            'success' => true,
            'code' => 200,
            'data' => [
                'valid' => true,
                'match' => [
                    'result' => 'likely',
                    'score' => 90,
                    'fields' => ['company_name' => ['result' => 'match', 'score' => 100, 'vies' => null]],
                ],
            ],
        ]);

        $result = $client->validate->check(vatNumber: 'GB288305674', matchCompanyName: 'Weio Ltd', matchPostcode: 'SW3 1GL');

        parse_str($transporter->getRequests()[0]->getUri()->getQuery(), $query);
        $this->assertSame('Weio Ltd', $query['match_company_name']);
        $this->assertSame('SW3 1GL', $query['match_postcode']);

        $this->assertNotNull($result->data);
        $this->assertNotNull($result->data->match);
        $this->assertSame('likely', $result->data->match->result);
        $this->assertSame(90, $result->data->match->score);
        $this->assertSame(100, $result->data->match->fields['company_name']->score ?? null);
    }

    public function testRatesListSendsProvinces(): void
    {
        [$client, $transporter] = $this->client();

        $client->rates->list(provinces: false);

        parse_str($transporter->getRequests()[0]->getUri()->getQuery(), $query);
        $this->assertArrayHasKey('provinces', $query);
        $this->assertContains($query['provinces'], ['0', 'false']);
    }
}
