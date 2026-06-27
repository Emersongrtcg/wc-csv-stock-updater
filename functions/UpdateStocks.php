<?php

declare(strict_types=1);

require_once 'SendRequests.php';

/**
 * @param array<int, int> $stocks
 */
function updateStocks(array $stocks)
{
    $requestBodies = new GetRequestBodies()($stocks);

    $response = sendRequests($requestBodies);

    echo $response;
}
