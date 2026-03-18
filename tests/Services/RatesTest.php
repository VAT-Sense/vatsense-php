<?php

namespace Tests\Services;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;
use VatsenseVatsense\Client;
use VatsenseVatsense\Core\Util;
use VatsenseVatsense\Rates\FindRate;
use VatsenseVatsense\Rates\RateCalculatePriceResponse;
use VatsenseVatsense\Rates\RateListResponse;
use VatsenseVatsense\Rates\RateListTypesResponse;

/**
 * @internal
 */
#[CoversNothing]
final class RatesTest extends TestCase
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

        $result = $this->client->rates->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RateListResponse::class, $result);
    }

    #[Test]
    public function testCalculatePrice(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->rates->calculatePrice(
            price: '20.00',
            taxType: 'excl'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RateCalculatePriceResponse::class, $result);
    }

    #[Test]
    public function testCalculatePriceWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->rates->calculatePrice(
            price: '20.00',
            taxType: 'excl',
            countryCode: 'GB',
            eu: true,
            ipAddress: '86.27.166.97',
            provinceCode: 'ON',
            type: 'ebooks',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RateCalculatePriceResponse::class, $result);
    }

    #[Test]
    public function testDetails(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->rates->details();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FindRate::class, $result);
    }

    #[Test]
    public function testFind(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->rates->find();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FindRate::class, $result);
    }

    #[Test]
    public function testListTypes(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->rates->listTypes();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RateListTypesResponse::class, $result);
    }
}
