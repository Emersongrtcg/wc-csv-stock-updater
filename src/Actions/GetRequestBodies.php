<?php

declare(strict_types=1);

namespace Actions;

use Objects\WcUpdateRequestBody;
use const MAX_PRODUCTS_PER_REQUEST;

/**
 * Formats the changed items list in the way WooCommerce API needs to be formated.
 */
final readonly class GetRequestBodies
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
        $chunkedArray = \array_chunk($changedItems, MAX_PRODUCTS_PER_REQUEST, true);
        foreach ($chunkedArray as $dataChunk) {
            $this->requestBodies[] = new WcUpdateRequestBody($dataChunk);
        }

        return $this->requestBodies;
    }
}
