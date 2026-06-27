<?php

declare(strict_types=1);

use Objects\WcUpdateRequestBody;

require_once 'PrepareRequest.php';

function sendSingleRequest(WcUpdateRequestBody $body): string
{
    $ch = prepareRequest($body);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_encode(json_decode($response), JSON_PRETTY_PRINT);
}
