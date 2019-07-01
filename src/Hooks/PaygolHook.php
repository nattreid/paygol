<?php

declare(strict_types=1);

namespace NAttreid\Paygol\Hooks;

use NAttreid\Form\Form;
use NAttreid\WebManager\Services\Hooks\HookFactory;
use Nette\ComponentModel\Component;
use Nette\Utils\ArrayHash;

/**
 * Class PaygolHook
 *
 * @author Attreid <attreid@gmail.com>
 */
class PaygolHook extends HookFactory
{

	/** @var IConfigurator */
	protected $configurator;

	public function init(): void
	{
		if (!$this->configurator->paygol) {
			$this->configurator->paygol = new PaygolConfig;
		}
	}

	/** @return Component */
	public function create(): Component
	{
		$form = $this->formFactory->create();
		$form->setAjaxRequest();

		$form->addText('serviceId', 'webManager.web.hooks.paygol.serviceId')
			->setDefaultValue($this->configurator->paygol->serviceId);

		$form->addText('conversionRate', 'webManager.web.hooks.paygol.conversionRate')
			->setDefaultValue($this->configurator->paygol->conversionRate);

		$form->addSubmit('save', 'form.save');

		$form->onSuccess[] = [$this, 'paygolFormSucceeded'];

		return $form;
	}

	public function paygolFormSucceeded(Form $form, ArrayHash $values): void
	{
		$config = $this->configurator->paygol;

		$config->serviceId = $values->serviceId ?: null;
		$config->conversionRate = $values->conversionRate ?: null;

		$this->configurator->paygol = $config;

		$this->flashNotifier->success('default.dataSaved');
	}
}