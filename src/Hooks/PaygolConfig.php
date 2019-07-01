<?php

declare(strict_types=1);

namespace NAttreid\Paygol\Hooks;

use Nette\SmartObject;

/**
 * Class PaygolConfig
 *
 * @property string|null $serviceId
 * @property float|null $conversionRate
 *
 * @author Attreid <attreid@gmail.com>
 */
class PaygolConfig
{
	use SmartObject;

	/** @var string|null */
	private $serviceId;

	/** @var float|null */
	private $conversionRate;

	protected function getServiceId(): ?string
	{
		return $this->serviceId;
	}

	protected function setServiceId(?string $serviceId): void
	{
		$this->serviceId = $serviceId;
	}

	protected function getConversionRate(): ?float
	{
		return $this->conversionRate;
	}

	protected function setConversionRate(?float $conversionRate): void
	{
		$this->conversionRate = $conversionRate;
	}


}