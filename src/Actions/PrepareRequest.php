<?php

declare(strict_types=1);

namespace Actions;

use CurlHandle;
use Objects\WcUpdateRequestBody;
use const CONSUMER_KEY;
use const CONSUMER_SECRET;
use const STORE_URL;

final readonly class PrepareRequest
{
    private CurlHandle $ch;

    public function __construct()
    {
        $url = STORE_URL . 'wp-json/wc/v3/products/batch';
        $this->ch = \curl_init($url);

        $pwd = CONSUMER_KEY . ":" . CONSUMER_SECRET;
        \curl_setopt($this->ch, CURLOPT_USERPWD, $pwd);

        \curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        \curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "POST");
        \curl_setopt($this->ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    }

    public function __invoke(WcUpdateRequestBody $body): CurlHandle
    {
        \curl_setopt($this->ch, CURLOPT_POSTFIELDS, $body->json());
        return $this->ch;
    }
}
