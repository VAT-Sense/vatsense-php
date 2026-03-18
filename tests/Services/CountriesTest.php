<?php

namespace Tests\Services;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;
use VatsenseVatsensePhp\Client;
use VatsenseVatsensePhp\Core\Util;
use VatsenseVatsensePhp\Countries\CountryListProvincesResponse;
use VatsenseVatsensePhp\Countries\CountryListResponse;

/**
 * @internal
 */
#[CoversNothing]
final class CountriesTest extends TestCase
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

        $result = $this->client->countries->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CountryListResponse::class, $result);
    }

    #[Test]
    public function testListProvinces(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->countries->listProvinces(countryCode: 'CA');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CountryListProvincesResponse::class, $result);
    }

    #[Test]
    public function testListProvincesWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->countries->listProvinces(countryCode: 'CA');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CountryListProvincesResponse::class, $result);
    }
}
