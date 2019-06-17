<?php

declare(strict_types=1);

namespace NAttreid\Paygol\Helpers\Response;

use NAttreid\Comgate\Helpers\Exceptions\PaygolException;
use Nette\SmartObject;
use Nette\Utils\Json;
use Nette\Utils\JsonException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class CheckoutResponse
 *
 * @property-read bool $completed
 * @property-read bool $rejected
 *
 * @author Attreid <attreid@gmail.com>
 */
class CheckoutResponse
{
	use SmartObject;

	/** @var bool */
	private $completed = false;

	/** @var bool */
	private $rejected = false;

	/**
	 * CheckoutResponse constructor.
	 * @param ResponseInterface $response
	 * @throws PaygolException
	 */
	public function __construct(ResponseInterface $response)
	{
		try {
			$data = Json::decode($response->getBody()->getContents());
			if ($data->data !== null) {
				switch ($data->data->status) {
					case  'completed':
						$this->completed = true;
						break;
					case 'failed':
					case 'rejected':
						$this->rejected = true;
						break;
				}
			}
		} catch (JsonException $ex) {
			throw new PaygolException("Invalid response from Paygol", $ex);
		}
	}

	protected function isCompleted(): bool
	{
		return $this->completed;
	}

	protected function isRejected(): bool
	{
		return $this->rejected;
	}
}