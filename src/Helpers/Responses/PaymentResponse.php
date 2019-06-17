<?php

declare(strict_types=1);

namespace NAttreid\Paygol\Helpers\Response;

use NAttreid\Comgate\Helpers\Exceptions\PaygolException;
use Nette\Application\Responses\RedirectResponse;
use Nette\SmartObject;
use Nette\Utils\Json;
use Nette\Utils\JsonException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class CheckoutResponse
 *
 * @property-read string $transactionId
 * @property-read string $redirectUrl
 * @property-read RedirectResponse $response
 *
 * @author Attreid <attreid@gmail.com>
 */
class PaymentResponse
{
	use SmartObject;

	/** @var string */
	private $transactionId;

	/** @var string */
	private $redirectUrl;

	/**
	 * PaymentResponse constructor.
	 * @param ResponseInterface $response
	 * @throws PaygolException
	 */
	public function __construct(ResponseInterface $response)
	{
		try {
			$data = Json::decode($response->getBody()->getContents());
			if ($data->data !== null) {
				if ($data->data->status === 'created') {
					$this->transactionId = $data->data->transaction_id;
					$this->redirectUrl = $data->data->payment_method_url;
					return;
				}
			}
		} catch (JsonException $ex) {
			throw new PaygolException("Invalid response from Paygol", $ex);
		}
		throw new PaygolException("Invalid response from Paygol");
	}

	/**
	 * @return string
	 */
	protected function getTransactionId(): string
	{
		return $this->transactionId;
	}

	/**
	 * @return string
	 */
	protected function getRedirectUrl(): string
	{
		return $this->redirectUrl;
	}

	protected function getResponse(): RedirectResponse
	{
		return new RedirectResponse($this->redirectUrl);
	}
}