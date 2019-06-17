<?php

declare(strict_types=1);

namespace NAttreid\Comgate\Helpers\Exceptions;

use Exception;
use Throwable;

/**
 * Class PaygolException
 *
 * @author Attreid <attreid@gmail.com>
 */
class PaygolException extends Exception
{
	public function __construct($message = "", Throwable $previous = null)
	{
		parent::__construct($message, 0, $previous);
	}
}