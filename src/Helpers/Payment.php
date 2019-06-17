<?php

declare(strict_types=1);

namespace NAttreid\Paygol\Helpers;

use NAttreid\Utils\Strings;
use Nette\SmartObject;

/**
 * Class Payment
 *
 * @property string $currency
 * @property float $price
 * @property int $identifier
 * @property string $method
 *
 * @author Attreid <attreid@gmail.com>
 */
abstract class Payment
{
	use SmartObject;

	/** @var string */
	private $currency;

	/** @var float */
	private $price;

	/** @var int */
	private $identifier;

	protected function getCurrency(): string
	{
		return $this->currency;
	}

	protected function setCurrency(string $currency): void
	{
		$this->currency = Strings::upper($currency);
	}

	protected function getPrice(): float
	{
		return $this->price;
	}

	protected function setPrice(float $price): void
	{
		$this->price = $price;
	}

	protected function getIdentifier(): int
	{
		return $this->identifier;
	}

	protected function setIdentifier(int $identifier): void
	{
		$this->identifier = $identifier;
	}

	protected abstract function getMethod(): string;
}