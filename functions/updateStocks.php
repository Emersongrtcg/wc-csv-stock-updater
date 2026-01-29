<?php

declare(strict_types=1);

require_once 'getRequestBodies.php';
require_once 'sendRequests.php';

/**
 * @param array<int, int> $stocks
 */
function updateStocks(array $stocks)
{
    $requestBodies = getRequestBodies($stocks);

    $response = sendRequests($requestBodies);

    echo $response;
}
