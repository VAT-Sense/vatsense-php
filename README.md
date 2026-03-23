# VAT Sense PHP SDK

The official PHP library for the [VAT Sense](https://vatsense.com) REST API. Validate VAT/EORI numbers, look up VAT/GST rates, calculate prices, convert currencies, and generate VAT-compliant invoices.

## Installation

<!-- x-release-please-start-version -->

```
composer require vatsense/vatsense-php
```

<!-- x-release-please-end -->

Requires PHP 8.1 or higher.

## Quick start

Create a client using your API key from the [VAT Sense dashboard](https://vatsense.com/dashboard). The API uses HTTP Basic Auth with `user` as the username and your API key as the password.

```php
<?php

use Vatsense\Client;

$client = new Client(
    username: 'user',
    password: 'your_api_key',
);
```

You can also set the `VAT_SENSE_USERNAME` and `VAT_SENSE_PASSWORD` environment variables and the client will pick them up automatically.

### Validate a VAT number

```php
$response = $client->validate->check(vatNumber: 'GB288305674');

if ($response->data->valid) {
    echo $response->data->company->companyName; // "BRITISH BROADCASTING CORPORATION"
    echo $response->data->company->companyAddress;
    echo $response->data->company->countryCode; // "GB"
}
```

VAT validation works for the UK, EU, Australia, Norway, Switzerland, South Africa, and Brazil.

### Validate an EORI number

```php
$response = $client->validate->check(eoriNumber: 'GB123456789000');

if ($response->data->valid) {
    echo $response->data->company->companyName;
}
```

EORI validation is available for UK and EU numbers only.

### Get a consultation number

If you need an official consultation number from VIES (EU) or HMRC (UK), provide your own VAT number as the requester:

```php
$response = $client->validate->check(
    vatNumber: 'FR12345678901',
    requesterVatNumber: 'FR98765432101',
);

echo $response->data->consultationNumber;
```

> **Note:** GB requester numbers only work for GB validations, and EU requester numbers only work for EU validations. Cross-region requests are not supported.

### Find the VAT rate for a country

```php
$rate = $client->rates->find(countryCode: 'DE');

echo $rate->data->countryName;      // "Germany"
echo $rate->data->taxRate->rate;     // 19
echo $rate->data->taxRate->class;    // "standard"
```

### Find a rate for a specific product type

```php
$rate = $client->rates->find(countryCode: 'DE', type: 'ebooks');

echo $rate->data->taxRate->rate;  // 7
echo $rate->data->taxRate->class; // "reduced"
```

### Find a rate by IP address

Useful for determining the correct rate based on your customer's location:

```php
$rate = $client->rates->find(ipAddress: '185.86.151.11');

echo $rate->data->countryCode; // "GB"
echo $rate->data->taxRate->rate; // 20
```

### Calculate a VAT-inclusive price

```php
use Vatsense\Rates\RateCalculatePriceParams\TaxType;

$result = $client->rates->calculatePrice(
    price: '100.00',
    taxType: TaxType::EXCL,
    countryCode: 'FR',
);

echo $result->data->vatPrice->priceInclVat;  // Price including VAT
echo $result->data->vatPrice->priceExclVat;  // Price excluding VAT
echo $result->data->vatPrice->vatRate;       // VAT rate applied
echo $result->data->vatPrice->vat;           // VAT amount
```

### List all VAT rates

```php
$rates = $client->rates->list();

foreach ($rates->data as $rate) {
    echo $rate->countryCode . ': ' . $rate->countryName . PHP_EOL;
}

// Filter to EU countries only
$euRates = $client->rates->list(eu: true);
```

## Handling errors

When the API returns an error, the library throws a typed exception:

```php
<?php

use Vatsense\Core\Exceptions\APIConnectionException;
use Vatsense\Core\Exceptions\APIStatusException;
use Vatsense\Core\Exceptions\RateLimitException;

try {
    $response = $client->validate->check(vatNumber: 'GB288305674');
} catch (APIConnectionException $e) {
    // Network issue, could not reach the API
    echo $e->getMessage();
} catch (RateLimitException $e) {
    // 429: Too many requests (300/min general limit, 3/sec for UK validation)
    echo "Rate limited, try again shortly";
} catch (APIStatusException $e) {
    // Covers all other HTTP errors
    echo $e->getMessage();
}
```

A `412` error means the upstream validation service (VIES, HMRC, etc.) is temporarily unavailable. These requests do not count against your usage quota.

| Cause            | Error Type                     |
| ---------------- | ------------------------------ |
| HTTP 400         | `BadRequestException`          |
| HTTP 401         | `AuthenticationException`      |
| HTTP 404         | `NotFoundException`            |
| HTTP 409         | `ConflictException`            |
| HTTP 412         | `APIStatusException`           |
| HTTP 429         | `RateLimitException`           |
| HTTP >= 500      | `InternalServerException`      |
| Timeout          | `APITimeoutException`          |
| Network error    | `APIConnectionException`       |

## Retries

Failed requests are automatically retried up to 2 times with exponential backoff. This includes connection errors, timeouts, 429, and 5xx responses.

```php
// Disable retries
$client = new Client(
    username: 'user',
    password: 'your_api_key',
    requestOptions: ['maxRetries' => 0],
);

// Or configure per request
$response = $client->validate->check(
    vatNumber: 'GB288305674',
    requestOptions: ['maxRetries' => 5],
);
```

## Available services

| Service               | Description                                     |
| --------------------- | ----------------------------------------------- |
| `$client->validate`   | Validate VAT and EORI numbers                   |
| `$client->rates`      | VAT/GST rate lookups, price calculations         |
| `$client->countries`  | Country data and province lookups                |
| `$client->currency`   | Exchange rates and currency conversion           |
| `$client->invoice`    | Create and manage VAT-compliant invoices         |
| `$client->usage`      | Check your API usage                             |

## Documentation

Full API documentation is available at [vatsense.com/documentation](https://vatsense.com/documentation).

## Versioning

This package follows [SemVer](https://semver.org/spec/v2.0.0.html) conventions. As the library is in initial development and has a major version of `0`, APIs may change at any time.

## Contributing

See [the contributing documentation](https://github.com/VAT-Sense/vatsense-php/tree/main/CONTRIBUTING.md).
