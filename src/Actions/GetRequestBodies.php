<?php

declare(strict_types=1);

namespace WcCsvStockUpdater\Actions;

use WcCsvStockUpdater\Objects\WcUpdateRequestBody;
use const WcCsvStockUpdater\MAX_PRODUCTS_PER_REQUEST as MAX_PER_REQUEST;

/**
 * Generate the list of request bodies that will be used send the requests.
 */
final class GetRequestBodies
{
    /**
     * @var array{WcUpdateRequestBody}
     */
    private array $requestBodies;

    /**
     * @return array{WcUpdateRequestBody} The list of request bodies, that can
     * be JSON-parsed by their public method json().
     */
    public function __invoke(array $changedItems): array
    {
        $chunkedArray = \array_chunk($changedItems, MAX_PER_REQUEST, true);
        foreach ($chunkedArray as $dataChunk) {
            $this->requestBodies[] = new WcUpdateRequestBody($dataChunk);
        }

        return $this->requestBodies;
    }
}
