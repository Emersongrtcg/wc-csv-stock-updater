<?php

declare(strict_types=1);

/**
 * @param array{update: array{array{id: int, stock_quantity: int}}} $data
 */
function sendRequest(CurlHandle $ch): string
{
    $response = curl_exec($ch);
    curl_close($ch);

    return json_encode(json_decode($response), JSON_PRETTY_PRINT);
}
