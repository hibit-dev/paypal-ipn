<?php namespace Paypal\Php\ValueObject;

class PaypalIpn
{
    protected string $value;

    public function __construct(array $data)
    {
        $formattedData = [];

        foreach ($data as $datum) {
            $datum = explode('=', $datum);

            if (count($datum) == 2) {
                // Since we do not want the plus in the datetime string to be encoded to a space, we manually encode it.
                if ($datum[0] === 'payment_date') {
                    if (substr_count($datum[1], '+') === 1) {
                        $datum[1] = str_replace('+', '%2B', $datum[1]);
                    }
                }

                $formattedData[$datum[0]] = urldecode($datum[1]);
            }
        }

        $this->value = $this->stringify($formattedData);
    }

    public function value(): string
    {
        return $this->value;
    }

    private function stringify(array $data): string
    {
        // Build the body of the verification post request, adding the _notify-validate command.
        $req = 'cmd=_notify-validate';

        foreach ($data as $key => $value) {
            $req .= sprintf('&%s=%s', $key, urlencode($value));
        }

        return $req;
    }
}
