<?php
declare(strict_types=1);

namespace NAttreid\Paygol\DI;

use NAttreid\Cms\Configurator\Configurator;
use NAttreid\Cms\DI\ExtensionTranslatorTrait;
use NAttreid\Paygol\Hooks\PaygolConfig;
use NAttreid\Paygol\Hooks\PaygolHook;
use NAttreid\WebManager\Services\Hooks\HookService;
use Nette\DI\Statement;

if (trait_exists('NAttreid\Cms\DI\ExtensionTranslatorTrait')) {
	class PaygolExtension extends AbstractPaygolExtension
	{
		use ExtensionTranslatorTrait;

		protected function prepareConfig(array $comgate)
		{
			$builder = $this->getContainerBuilder();
			$hook = $builder->getByType(HookService::class);
			if ($hook) {
				$builder->addDefinition($this->prefix('hook'))
					->setType(PaygolHook::class);

				$this->setTranslation(__DIR__ . '/../lang/', [
					'webManager'
				]);

				return new Statement('?->paygol \?: new ' . PaygolConfig::class, ['@' . Configurator::class]);
			} else {
				return parent::prepareConfig($comgate);
			}
		}
	}
} else {
	class PaygolExtension extends AbstractPaygolExtension
	{
	}
}