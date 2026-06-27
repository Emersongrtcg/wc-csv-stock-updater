<?php

declare(strict_types=1);

use Objects\WcUpdateRequestBody;

require_once 'SendMultipleRequests.php';
require_once 'SendSingleRequest.php';

/**
 * @param array{WcUpdateRequestBody} $bodies
 */
function sendRequests(array $bodies): string
{
    //Is there more than one request body? If yes, use the multiple sender. If
    //not, use the single sender.
    return isset($bodies[1]) ?
        sendMultipleRequests($bodies) :
        sendSingleRequest($bodies[0]);
}
