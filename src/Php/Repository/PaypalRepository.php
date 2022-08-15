<?php namespace Paypal\Php\Repository;

use Paypal\Php\ValueObject\PaypalIpn;
use Paypal\Php\Exception\IpnException;

class PaypalRepository implements PaypalRepositoryInterface
{
    private string $handlerUrl;

    public function __construct(string $handlerUrl)
    {
        $this->handlerUrl = $handlerUrl;
    }

    /**
     * @throws IpnException
     */
    public function verify(PaypalIpn $paypalIpn): void
    {
        $ch = curl_init($this->handlerUrl);

        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'User-Agent: HiBit-IPN',
            'Connection: Close',
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $paypalIpn->value());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);

        curl_setopt($ch, CURLOPT_SSLVERSION, 6);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $response = curl_exec($ch); // Holds the response string from the PayPal's IPN.

        $curlCode = curl_errno($ch); // ErrorID
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if (empty($response)) {
            throw new IpnException(sprintf('cURL error: %d', $curlCode));
        }

        if ($httpCode !== 200) {
            throw new IpnException(sprintf('IPN responded with HTTP code: %d', $httpCode));
        }

        // Check if PayPal verifies the IPN data, and if so, return true.
        if ($response === 'INVALID') {
            throw new IpnException('Paypal response is invalid');
        }
    }
}
