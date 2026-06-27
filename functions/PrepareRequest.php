<?php

declare(strict_types=1);

/**
 * @param array{update: array{array{id: int, stock_quantity: int}}} $body
 */
function prepareRequest(array $body): CurlHandle
{
    $url = STORE_URL . 'wp-json/wc/v3/products/batch';
    $ch = curl_init($url);
    
    $pwd = CONSUMER_KEY . ":" . CONSUMER_SECRET;
    curl_setopt($ch, CURLOPT_USERPWD, $pwd);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

    return $ch;
}
