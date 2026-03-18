<?php

namespace Tests\Services;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;
use Vatsense\Client;
use Vatsense\Core\Util;
use Vatsense\Currency\CurrencyCalculateVatPriceResponse;
use Vatsense\Currency\CurrencyConvertResponse;
use Vatsense\Currency\CurrencyListResponse;

/**
 * @internal
 */
#[CoversNothing]
final class CurrencyTest extends TestCase
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
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->currency->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CurrencyListResponse::class, $result);
    }

    #[Test]
    public function testCalculateVatPrice(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->currency->calculateVatPrice(
            price: '20.00',
            taxType: 'excl',
            vatRate: 5
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CurrencyCalculateVatPriceResponse::class, $result);
    }

    #[Test]
    public function testCalculateVatPriceWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->currency->calculateVatPrice(
            price: '20.00',
            taxType: 'excl',
            vatRate: 5
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CurrencyCalculateVatPriceResponse::class, $result);
    }

    #[Test]
    public function testConvert(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->currency->convert(
            amount: '39.99',
            from: 'USD',
            to: 'GBP'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CurrencyConvertResponse::class, $result);
    }

    #[Test]
    public function testConvertWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->currency->convert(
            amount: '39.99',
            from: 'USD',
            to: 'GBP'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CurrencyConvertResponse::class, $result);
    }
}
