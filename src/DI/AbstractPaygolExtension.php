<?php

declare(strict_types=1);

namespace NAttreid\Paygol\DI;

use NAttreid\Paygol\Hooks\PaygolConfig;
use NAttreid\Paygol\IPaygolClientFactory;
use NAttreid\Paygol\PaygolClient;
use Nette\DI\CompilerExtension;

/**
 * Class AbstractPaygolExtension
 *
 * @author Attreid <attreid@gmail.com>
 */
abstract class AbstractPaygolExtension extends CompilerExtension
{

	private $defaults = [
		'url' => 'https://www.paygol.com/',
		'serviceId' => null,
		'conversionRate' => null
	];

	public function loadConfiguration(): void
	{
		$config = $this->validateConfig($this->defaults, $this->getConfig());
		$builder = $this->getContainerBuilder();

		$paygol = $this->prepareConfig($config);

		$builder->addDefinition($this->prefix('factory'))
			->setImplement(IPaygolClientFactory::class)
			->setFactory(PaygolClient::class)
			->setArguments([
				$paygol,
				$config['url'],
			]);
	}

	protected function prepareConfig(array $config)
	{
		$builder = $this->getContainerBuilder();
		return $builder->addDefinition($this->prefix('config'))
			->setFactory(PaygolConfig::class)
			->addSetup('$serviceId', [$config['serviceId']])
			->addSetup('$conversionRate', [$config['conversionRate']]);
	}
}