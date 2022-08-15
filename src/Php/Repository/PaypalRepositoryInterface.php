<?php namespace Paypal\Php\Repository;

use Paypal\Php\ValueObject\PaypalIpn;
use Paypal\Php\Exception\IpnException;

interface PaypalRepositoryInterface
{
    /**
     * @throws IpnException
     */
    public function verify(PaypalIpn $paypalIpn): void;
}
