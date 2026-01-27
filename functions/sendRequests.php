<?php

declare(strict_types=1);

require_once 'sendMultipleRequests.php';
require_once 'sendSingleRequest.php';

/**
 * @param array{array{update: array{array{id: int, stock_quantity: int}}}} $bodies
 */
function sendRequests(array $bodies): string
{
    //Is there more than one request body? If yes, use the multiple sender. If
    //not, use the single sender.
    return isset($bodies[1]) ?
        sendMultipleRequests($bodies) :
        sendSingleRequest($bodies[0]);
}
