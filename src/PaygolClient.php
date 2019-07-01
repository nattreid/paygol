<?php

declare(strict_types=1);

namespace NAttreid\Paygol;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use NAttreid\Comgate\Helpers\Exceptions\PaygolException;
use NAttreid\Paygol\Helpers\Exceptions\CredentialsNotSetException;
use NAttreid\Paygol\Helpers\Payment;
use NAttreid\Paygol\Helpers\Response\CheckoutResponse;
use NAttreid\Paygol\Helpers\Response\PaymentResponse;
use NAttreid\Paygol\Hooks\PaygolConfig;
use NAttreid\Paygol\Payments\Helpers\Payer;

/**
 * Class PaygolClient
 *
 * @author Attreid <attreid@gmail.com>
 */
class PaygolClient
{

	/** @var PaygolConfig */
	private $config;

	/** @var Client */
	private $client;

	/** @var string */
	private $successUrl;

	/** @var string */
	private $errorUrl;

	public function __construct(PaygolConfig $config, string $url)
	{
		$this->config = $config;
		$this->client = new Client(['base_uri' => $url]);
	}

	public function setSuccessUrl(string $url): void
	{
		$this->successUrl = $url;
	}

	public function setErrorUrl(string $url): void
	{
		$this->errorUrl = $url;
	}

	/**
	 * @param Payment $payment
	 * @param Payer $payer
	 * @return PaymentResponse
	 * @throws CredentialsNotSetException
	 * @throws PaygolException
	 */
	public function payment(Payment $payment, Payer $payer): PaymentResponse
	{
		if (empty($this->config->serviceId)) {
			throw new CredentialsNotSetException('Secret key must be set');
		}

		$args = [
			'pg_mode' => 'api',
			'pg_serviceid' => $this->config->serviceId,
			'pg_format' => 'json',
			'pg_method' => $payment->method,
			'pg_currency' => $payment->currency,
			'pg_price' => $payment->price,
			'pg_custom' => $payment->identifier,
			'pg_country' => $payer->country,
			'pg_language' => $payer->language,
			'pg_ip' => $payer->ip,
			'pg_email' => $payer->email,
			'pg_first_name' => $payer->firstName,
			'pg_last_name' => $payer->lastName,
			'pg_personalid' => $payer->identifier,
		];

		if ($this->successUrl !== null) {
			$args['pg_return_url'] = $this->successUrl;
		}

		if ($this->errorUrl !== null) {
			$args['pg_cancel_url'] = $this->errorUrl;
		}

		try {
			$result = $this->client->post('pay', [
				'form_params' => $args
			]);
		} catch (ClientException $ex) {
			throw new PaygolException($ex->getMessage(), $ex);
		}

		return new PaymentResponse($result);
	}

	/**
	 * @param string $transactionId
	 * @return CheckoutResponse
	 * @throws CredentialsNotSetException
	 * @throws PaygolException
	 */
	public function checkout(string $transactionId): CheckoutResponse
	{
		if (empty($this->config->serviceId)) {
			throw new CredentialsNotSetException('ServiceId key must be set');
		}

		$args = [
			'service' => $this->config->serviceId,
			'id' => $transactionId,
			'format' => 'json'
		];

		try {
			$result = $this->client->post('api/check-payment', [
				'form_params' => $args
			]);
		} catch (ClientException $ex) {
			throw new PaygolException($ex->getMessage(), $ex);
		}

		return new CheckoutResponse($result);
	}
}

interface IPaygolClientFactory
{
	public function create(): PaygolClient;
}


