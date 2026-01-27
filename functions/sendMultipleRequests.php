<?php

declare(strict_types=1);

/**
 * @param array{array{update: array{array{id: int, stock_quantity: int}}}} $bodies
 */
function sendMultipleRequests(array $bodies): string
{
    $cmh = curl_multi_init();
    foreach ($bodies as $body) {
        $ch = prepareRequest($body);
        curl_multi_add_handle($cmh, $ch);
    }

    $responses = executeMultiHandles($cmh);

    curl_multi_close($cmh);

    return $responses;
}

function executeMultiHandles(CurlMultiHandle $cmh): string
{
    $responses = '';
    do {
        curl_multi_exec($cmh, $running);
        $responses .= getMessages($cmh);
    } while ($running);

    return $responses;
}

function getMessages(CurlMultiHandle $cmh): string
{
    $message = curl_multi_info_read($cmh);
    if (false === $message) {
        return '';
    }

    $response = curl_multi_getcontent($message['handle']);

    return json_encode(json_decode($response), JSON_PRETTY_PRINT) . PHP_EOL;
}
