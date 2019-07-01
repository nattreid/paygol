# Paygol pro Nette Framework
Nastavení v **config.neon**
```neon
extensions:
    paygol: NAttreid\Paygol\DI\PaygolExtension

bPayments:
    serviceId: '123456789'
    conversionRate: xx
```

### Použití
```php
/** @var \NAttreid\Paygol\IPaygolClientFactory @inject */
public $paygolClientFactory;

public function payment() {
    $payment = $this->createPayment();
    $payment->identifier = 12345678;
    $payment->currency = 'EUR';
    $payment->price = 100;

    $payer = new Payer();
    $payer->identifier = 123456789;
    $payer->country = 'GB';
    $payer->language = 'EUR';
    $payer->email = 'some@email.com';
    $payer->firstName = 'John';
    $payer->lastName = 'Doe';
    $payer->ip = '123.123.123.123';

    $paygolClient = $this->paygolClientFactory->create();
    $paygolClient->setSuccessUrl('//domain.com/success');
    $paygolClient->setErrorUrl('//domain.com/error');

    $response = $paygolClient->payment($payment, $payer);

    $this->order->setPaygolTransactionId($response->transactionId);

    $presenter->sendResponse($response->response);
}

public function paygolCheckPayment(): void
{
    $paygol = $this->paygolClientFactory->create();

    $status = $paygol->checkout($paygolTransactionId);

    if ($status->completed) {
        
    } elseif ($status->rejected) {
        
    }
}
```