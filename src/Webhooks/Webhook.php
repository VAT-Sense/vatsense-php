<?php

declare(strict_types=1);

namespace Vatsense\Webhooks;

/**
 * Checking the signature of VAT Sense webhook events.
 *
 * Every event is a signed JSON `POST` with a `VatSense-Signature` header such as
 * `t=1793365200,v1=5257a8...`: `v1` is the hex HMAC-SHA256 of the timestamp, a
 * full stop and the raw request body, keyed with the endpoint's signing secret
 * (`whsec_...`). For 24 hours after a secret is rolled the header carries a
 * second `v1`, so any match is accepted.
 *
 * ```php
 * $event = Webhook::constructEvent(
 *     file_get_contents('php://input'),
 *     $_SERVER['HTTP_VATSENSE_SIGNATURE'] ?? null,
 *     'whsec_...',
 * );
 * ```
 */
final class Webhook
{
    /** The name of the header that carries the signature. */
    public const SIGNATURE_HEADER = 'VatSense-Signature';

    /** Events whose timestamp is more than this many seconds from now are refused. */
    public const DEFAULT_TOLERANCE = 300;

    /**
     * Check an event's `VatSense-Signature` header against its raw body.
     *
     * @param string $payload the raw request body, exactly as received
     * @param string|null $header the value of the `VatSense-Signature` header
     * @param string $secret the endpoint's signing secret, starting `whsec_`
     * @param int|null $tolerance refuse events signed more than this many seconds ago; null skips the check
     * @param int|null $now the current Unix time, for tests
     *
     * @throws WebhookSignatureException
     */
    public static function verifySignature(
        string $payload,
        ?string $header,
        #[\SensitiveParameter]
        string $secret,
        ?int $tolerance = self::DEFAULT_TOLERANCE,
        ?int $now = null,
    ): void {
        if (null === $header || '' === $header) {
            throw new WebhookSignatureException('The VatSense-Signature header is missing.');
        }

        if ('' === $secret) {
            throw new WebhookSignatureException('No signing secret was given.');
        }

        $timestamp = null;
        $signatures = [];

        foreach (explode(',', $header) as $part) {
            $pair = explode('=', trim($part), 2);

            if (2 !== count($pair)) {
                continue;
            }

            [$key, $value] = $pair;

            if ('t' === $key) {
                if (1 !== preg_match('/^\d+$/', $value)) {
                    throw new WebhookSignatureException("The signature header's timestamp is not a number.");
                }

                $timestamp = (int) $value;
            } elseif ('v1' === $key && '' !== $value) {
                $signatures[] = $value;
            }
        }

        if (null === $timestamp) {
            throw new WebhookSignatureException('The signature header has no timestamp.');
        }

        if ([] === $signatures) {
            throw new WebhookSignatureException('The signature header has no v1 signature.');
        }

        $now ??= time();

        if (null !== $tolerance && abs($now - $timestamp) > $tolerance) {
            throw new WebhookSignatureException("The event's timestamp is outside the tolerance.");
        }

        $expected = hash_hmac('sha256', $timestamp.'.'.$payload, $secret);

        foreach ($signatures as $signature) {
            if (hash_equals($expected, $signature)) {
                return;
            }
        }

        throw new WebhookSignatureException('No signature matches the payload.');
    }

    /**
     * Check the signature, then return the event (`id`, `type`, `created`,
     * `livemode`, `data`) as an array.
     *
     * @return array<string,mixed>
     *
     * @throws WebhookSignatureException
     */
    public static function constructEvent(
        string $payload,
        ?string $header,
        #[\SensitiveParameter]
        string $secret,
        ?int $tolerance = self::DEFAULT_TOLERANCE,
        ?int $now = null,
    ): array {
        self::verifySignature($payload, $header, $secret, $tolerance, $now);

        $event = json_decode($payload, true);

        if (!is_array($event) || array_is_list($event)) {
            throw new WebhookSignatureException('The payload is not a JSON object.');
        }

        /** @var array<string,mixed> $event */
        return $event;
    }
}
