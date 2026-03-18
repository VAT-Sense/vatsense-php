<?php

namespace Tests\Services;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;
use VatsenseVatsense\Client;
use VatsenseVatsense\Core\Util;
use VatsenseVatsense\Invoice\InvoiceDeleteResponse;
use VatsenseVatsense\Invoice\InvoiceListResponse;
use VatsenseVatsense\Invoice\InvoiceResponse;

/**
 * @internal
 */
#[CoversNothing]
final class InvoiceTest extends TestCase
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
    public function testCreate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->invoice->create(
            business: [
                'address' => "123 Example Street\nLondon\nSW3 1GL\nUnited Kingdom",
                'name' => 'VAT Sense',
                'vatNumber' => 'GB12345678',
            ],
            currencyCode: 'USD',
            date: '2018-06-03 14:02:00',
            items: [
                [
                    'item' => 'Standard payment plan',
                    'priceEach' => 19.99,
                    'quantity' => 1,
                    'vatRate' => 20,
                ],
            ],
            taxPoint: '2018-06-03 14:02:00',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InvoiceResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->invoice->create(
            business: [
                'address' => "123 Example Street\nLondon\nSW3 1GL\nUnited Kingdom",
                'name' => 'VAT Sense',
                'vatNumber' => 'GB12345678',
                'bankAccount' => 'bank_account',
                'companyNumber' => '9839222',
                'email' => 'dev@stainless.com',
                'logo' => 'https://example.com',
                'phone' => 'phone',
                'website' => 'https://example.com',
            ],
            currencyCode: 'USD',
            date: '2018-06-03 14:02:00',
            items: [
                [
                    'item' => 'Standard payment plan',
                    'priceEach' => 19.99,
                    'quantity' => 1,
                    'vatRate' => 20,
                    'discountRate' => 40,
                ],
            ],
            taxPoint: '2018-06-03 14:02:00',
            conversion: ['currencyCode' => 'GBP', 'rate' => 1.523],
            customer: [
                'name' => 'Demo Co.',
                'address' => "65 Demo Road\nLondon\nSW1 3DE\nUnited Kingdom",
                'companyNumber' => '5584922',
                'countryCode' => 'country_code',
                'email' => 'dev@stainless.com',
                'logo' => 'https://example.com',
                'vatNumber' => 'GB912343332',
            ],
            hasVat: true,
            invoiceNumber: '203',
            isCopy: true,
            isReverseCharge: true,
            notes: 'notes',
            padInvoiceNumber: 2,
            serial: 'serial',
            taxType: 'incl',
            type: 'sale',
            zeroRated: true,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InvoiceResponse::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->invoice->retrieve('in5aeae457cda2a');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InvoiceResponse::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->invoice->update(
            'in5aeae457cda2a',
            business: [
                'address' => "123 Example Street\nLondon\nSW3 1GL\nUnited Kingdom",
                'name' => 'VAT Sense',
                'vatNumber' => 'GB12345678',
            ],
            currencyCode: 'USD',
            date: '2018-06-03 14:02:00',
            items: [
                [
                    'item' => 'Standard payment plan',
                    'priceEach' => 19.99,
                    'quantity' => 1,
                    'vatRate' => 20,
                ],
            ],
            taxPoint: '2018-06-03 14:02:00',
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

        $result = $this->client->invoice->update(
            'in5aeae457cda2a',
            business: [
                'address' => "123 Example Street\nLondon\nSW3 1GL\nUnited Kingdom",
                'name' => 'VAT Sense',
                'vatNumber' => 'GB12345678',
                'bankAccount' => 'bank_account',
                'companyNumber' => '9839222',
                'email' => 'dev@stainless.com',
                'logo' => 'https://example.com',
                'phone' => 'phone',
                'website' => 'https://example.com',
            ],
            currencyCode: 'USD',
            date: '2018-06-03 14:02:00',
            items: [
                [
                    'item' => 'Standard payment plan',
                    'priceEach' => 19.99,
                    'quantity' => 1,
                    'vatRate' => 20,
                    'discountRate' => 40,
                ],
            ],
            taxPoint: '2018-06-03 14:02:00',
            conversion: ['currencyCode' => 'GBP', 'rate' => 1.523],
            customer: [
                'name' => 'Demo Co.',
                'address' => "65 Demo Road\nLondon\nSW1 3DE\nUnited Kingdom",
                'companyNumber' => '5584922',
                'countryCode' => 'country_code',
                'email' => 'dev@stainless.com',
                'logo' => 'https://example.com',
                'vatNumber' => 'GB912343332',
            ],
            hasVat: true,
            invoiceNumber: '203',
            isCopy: true,
            isReverseCharge: true,
            notes: 'notes',
            padInvoiceNumber: 2,
            serial: 'serial',
            taxType: 'incl',
            type: 'sale',
            zeroRated: true,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InvoiceResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->invoice->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InvoiceListResponse::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->invoice->delete('in5aeae457cda2a');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InvoiceDeleteResponse::class, $result);
    }
}
