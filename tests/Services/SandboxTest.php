<?php

namespace Tests\Services;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;
use Vatsense\Client;
use Vatsense\Core\Util;
use Vatsense\Sandbox\SandboxGenerateKeyResponse;

/**
 * @internal
 */
#[CoversNothing]
final class SandboxTest extends TestCase
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
    public function testGenerateKey(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->sandbox->generateKey();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SandboxGenerateKeyResponse::class, $result);
    }
}
