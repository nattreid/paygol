<?php

declare(strict_types=1);

namespace NAttreid\Paygol\Helpers\Payments;

use NAttreid\Paygol\Helpers\Payment;

/**
 * Class PagoFacil
 *
 * @author Attreid <attreid@gmail.com>
 */
class PagoFacil extends Payment
{

	protected function getMethod(): string
	{
		return 'pagofacil';
	}
}