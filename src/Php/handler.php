<?php

use Paypal\Php\Exception\IpnException;
use Paypal\Php\ValueObject\PaypalIpn;
use Paypal\Php\Repository\PaypalRepository;

//TODO Should be defined as ENV variable depending on the environment
define('PAYPAL_IPN_HANDLER', 'https://ipnpb.sandbox.paypal.com/cgi-bin/webscr'); //Sandbox
//define('PAYPAL_IPN_HANDLER', 'https://ipnpb.paypal.com/cgi-bin/webscr'); //Production

try {
    // TODO validate receiver_email value match your account
    // TODO validate mc_currency match the currency you expect
    // TODO validate mc_gross match the product/service price
    // TODO validate txn_id was not previously processed
    // TODO validate payment_status

    $paypalRepository = new PaypalRepository(PAYPAL_IPN_HANDLER);

    // Verify that we have a correct and valid IPN message
    $paypalRepository->verify(new PaypalIpn($_POST));

    // TODO log payment information and details in success log
    // TODO process related products and/or services
} catch (IpnException $e) {
    // TODO log exception and error to review manually
}

//TODO return HTTP 200 code with empty content
