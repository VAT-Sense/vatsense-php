<?php

namespace Tests\Services\Invoice;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;
use Vatsense\Client;
use Vatsense\Core\Util;
use Vatsense\Invoice\InvoiceResponse;
use Vatsense\Invoice\Item\ItemGetResponse;

/**
 * @internal
 */
#[CoversNothing]
final class ItemTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(
            username: 'My Username',
            password: 'My Password',
            baseUrl: $testUrl,
        );

        $this->client = $client;
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->invoice->item->retrieve(
            'ii5aeae457ce201',
            invoiceID: 'in5aeae457cda2a'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ItemGetResponse::class, $result);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->invoice->item->retrieve(
            'ii5aeae457ce201',
            invoiceID: 'in5aeae457cda2a'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ItemGetResponse::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->invoice->item->update(
            'ii5aeae457ce201',
            invoiceID: 'in5aeae457cda2a',
            item: 'Standard payment plan',
            priceEach: 19.99,
            quantity: 1,
            vatRate: 20,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InvoiceResponse::class, $result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->invoice->item->update(
            'ii5aeae457ce201',
            invoiceID: 'in5aeae457cda2a',
            item: 'Standard payment plan',
            priceEach: 19.99,
            quantity: 1,
            vatRate: 20,
            discountRate: 40,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InvoiceResponse::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->invoice->item->delete(
            'ii5aeae457ce201',
            invoiceID: 'in5aeae457cda2a'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InvoiceResponse::class, $result);
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->invoice->item->delete(
            'ii5aeae457ce201',
            invoiceID: 'in5aeae457cda2a'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InvoiceResponse::class, $result);
    }

    #[Test]
    public function testAdd(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->invoice->item->add(
            'in5aeae457cda2a',
            items: [
                [
                    'item' => 'Standard payment plan',
                    'priceEach' => 19.99,
                    'quantity' => 1,
                    'vatRate' => 20,
                ],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InvoiceResponse::class, $result);
    }

    #[Test]
    public function testAddWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->invoice->item->add(
            'in5aeae457cda2a',
            items: [
                [
                    'item' => 'Standard payment plan',
                    'priceEach' => 19.99,
                    'quantity' => 1,
                    'vatRate' => 20,
                    'discountRate' => 40,
                ],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InvoiceResponse::class, $result);
    }
}
