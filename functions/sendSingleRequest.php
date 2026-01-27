<?php

declare(strict_types=1);

require_once 'prepareRequest.php';

/**
 * @param array{update: array{array{id: int, stock_quantity: int}}} $body
 */
function sendSingleRequest(array $body): string
{
    $ch = prepareRequest($body);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_encode(json_decode($response), JSON_PRETTY_PRINT);
}
