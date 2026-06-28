<?php

declare(strict_types=1);

namespace WcCsvStockUpdater\Actions;

use WcCsvStockUpdater\Objects\WcUpdateRequestBody;

final class SendRequests
{
    /**
     * @param array{WcUpdateRequestBody} $bodies
     */
    public function __invoke(array $bodies): string
    {
        // Is there more than one request body? If yes, use the multiple sender.
        // If not, use the single sender.
        return isset($bodies[1]) ?
            new SendMultipleRequests()($bodies) :
            new SendSingleRequest()($bodies[0]);
    }
}
