<?php

declare(strict_types=1);

namespace NAttreid\Paygol\Hooks;

use Nette\SmartObject;

/**
 * Class PaygolConfig
 *
 * @property string|null $serviceId
 *
 * @author Attreid <attreid@gmail.com>
 */
class PaygolConfig
{
	use SmartObject;

	/** @var string|null */
	private $serviceId;

	protected function getServiceId(): ?string
	{
		return $this->serviceId;
	}

	protected function setServiceId(?string $serviceId): void
	{
		$this->serviceId = $serviceId;
	}
}