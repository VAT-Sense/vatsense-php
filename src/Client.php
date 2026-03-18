<?php

declare(strict_types=1);

namespace Vatsense;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Vatsense\Core\BaseClient;
use Vatsense\Core\Util;
use Vatsense\Services\CountriesService;
use Vatsense\Services\CurrencyService;
use Vatsense\Services\InvoiceService;
use Vatsense\Services\RatesService;
use Vatsense\Services\SandboxService;
use Vatsense\Services\UsageService;
use Vatsense\Services\ValidateService;

/**
 * @phpstan-import-type NormalizedRequest from \Vatsense\Core\BaseClient
 * @phpstan-import-type RequestOpts from \Vatsense\RequestOptions
 */
class Client extends BaseClient
{
    public string $username;

    public string $password;

    /**
     * @api
     */
    public RatesService $rates;

    /**
     * @api
     */
    public CountriesService $countries;

    /**
     * @api
     */
    public ValidateService $validate;

    /**
     * @api
     */
    public CurrencyService $currency;

    /**
     * @api
     */
    public InvoiceService $invoice;

    /**
     * @api
     */
    public UsageService $usage;

    /**
     * @api
     */
    public SandboxService $sandbox;

    /**
     * @param RequestOpts|null $requestOptions
     */
    public function __construct(
        ?string $username = null,
        ?string $password = null,
        ?string $baseUrl = null,
        RequestOptions|array|null $requestOptions = null,
    ) {
        $this->username = (string) ($username ?? Util::getenv('VAT_SENSE_USERNAME'));
        $this->password = (string) ($password ?? Util::getenv('VAT_SENSE_PASSWORD'));

        $baseUrl ??= Util::getenv(
            'VAT_SENSE_BASE_URL'
        ) ?: 'https://api.vatsense.com/1.0';

        $options = RequestOptions::parse(
            RequestOptions::with(
                uriFactory: Psr17FactoryDiscovery::findUriFactory(),
                streamFactory: Psr17FactoryDiscovery::findStreamFactory(),
                requestFactory: Psr17FactoryDiscovery::findRequestFactory(),
                transporter: Psr18ClientDiscovery::find(),
            ),
            $requestOptions,
        );

        parent::__construct(
            headers: [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'User-Agent' => sprintf('vat-sense/PHP %s', VERSION),
                'X-Stainless-Lang' => 'php',
                'X-Stainless-Package-Version' => '0.2.0',
                'X-Stainless-Arch' => Util::machtype(),
                'X-Stainless-OS' => Util::ostype(),
                'X-Stainless-Runtime' => php_sapi_name(),
                'X-Stainless-Runtime-Version' => phpversion(),
            ],
            baseUrl: $baseUrl,
            options: $options
        );

        $this->rates = new RatesService($this);
        $this->countries = new CountriesService($this);
        $this->validate = new ValidateService($this);
        $this->currency = new CurrencyService($this);
        $this->invoice = new InvoiceService($this);
        $this->usage = new UsageService($this);
        $this->sandbox = new SandboxService($this);
    }

    /**
     * @param array{basicAuth?: bool} $security
     *
     * @return array<string,string>
     */
    protected function authHeaders(array $security): array
    {
        return [...($security['basicAuth'] ?? false) ? $this->basicAuth() : []];
    }

    /** @return array<string,string> */
    protected function basicAuth(): array
    {
        if (!$this->username && !$this->password) {
            return [];
        }

        $base64_credentials = base64_encode("{$this->username}:{$this->password}");

        return ['Authorization' => "Basic {$base64_credentials}"];
    }

    /**
     * @internal
     *
     * @param string|list<string> $path
     * @param array<string,mixed> $query
     * @param array<string,string|int|list<string|int>|null> $headers
     * @param RequestOpts|null $opts
     * @param array{basicAuth?: bool}|null $security
     *
     * @return array{NormalizedRequest, RequestOptions}
     */
    protected function buildRequest(
        string $method,
        string|array $path,
        array $query,
        array $headers,
        mixed $body,
        RequestOptions|array|null $opts,
        ?array $security = null,
    ): array {
        return parent::buildRequest(
            method: $method,
            path: $path,
            query: $query,
            headers: [
                ...$this->authHeaders(security: ($security ?? ['basicAuth' => true])),
                ...$headers,
            ],
            body: $body,
            opts: $opts,
            security: $security,
        );
    }
}
