<?php

declare(strict_types=1);

namespace NAttreid\Paygol\Payments\Helpers;

use NAttreid\Utils\Strings;
use Nette\SmartObject;

/**
 * Class Payer
 *
 * @property string $country
 * @property string $language
 * @property string $ip
 * @property string $email
 * @property string $firstName
 * @property string $lastName
 * @property int $identifier
 *
 * @author Attreid <attreid@gmail.com>
 */
class Payer
{
	use SmartObject;

	/** @var string */
	private $country;

	/** @var string */
	private $language;

	/** @var string */
	private $ip;

	/** @var string */
	private $email;

	/** @var string */
	private $firstName;

	/** @var string */
	private $lastName;

	/** @var int */
	private $customerId;

	protected function getCountry(): string
	{
		return $this->country;
	}

	protected function setCountry(string $country): void
	{
		$this->country = Strings::upper($country);
	}

	protected function getLanguage(): string
	{
		return $this->language;
	}

	protected function setLanguage(string $language): void
	{
		$this->language = Strings::lower($language);
	}

	protected function getIp(): string
	{
		return $this->ip;
	}

	protected function setIp(string $ip): void
	{
		$this->ip = $ip;
	}

	protected function getEmail(): string
	{
		return $this->email;
	}

	protected function setEmail(string $email): void
	{
		$this->email = $email;
	}

	protected function getFirstName(): string
	{
		return $this->firstName;
	}

	protected function setFirstName(string $firstName): void
	{
		$this->firstName = $firstName;
	}

	protected function getLastName(): string
	{
		return $this->lastName;
	}

	protected function setLastName(string $lastName): void
	{
		$this->lastName = $lastName;
	}

	protected function getIdentifier(): int
	{
		return $this->identifier;
	}

	protected function setIdentifier(int $identifier): void
	{
		$this->identifier = $identifier;
	}
}