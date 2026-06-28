<?php

declare(strict_types=1);

use Objects\WcUpdateRequestBody;

final readonly class PrepareRequest
{
    private CurlHandle $ch;

    public function __construct()
    {
        $url = STORE_URL . 'wp-json/wc/v3/products/batch';
        $this->ch = curl_init($url);

        $pwd = CONSUMER_KEY . ":" . CONSUMER_SECRET;
        curl_setopt($this->ch, CURLOPT_USERPWD, $pwd);

        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    }
    public function __invoke(WcUpdateRequestBody $body): CurlHandle
    {
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $body->json());
        return $this->ch;
    }
}
