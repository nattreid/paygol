<?php

declare(strict_types=1);

namespace NAttreid\Paygol\Helpers\Payments;

use NAttreid\Paygol\Helpers\Payment;

/**
 * Class RapiPago
 *
 * @author Attreid <attreid@gmail.com>
 */
class RapiPago extends Payment
{

	protected function getMethod(): string
	{
		return 'rapipago';
	}
}