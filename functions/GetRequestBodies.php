<?php

declare(strict_types=1);

/**
 * Formats the changed items list in the way WooCommerce API needs to be formated.
 * @return array{array{update: array{array{id: int, stock_quantity: int}}}} The
 * list of request bodies, ready to be JSON-parsed.
 */
function getRequestBodies(array $data): array
{
    $preparedData = [];

    $chunkedArray = array_chunk($data, MAX_PRODUCTS_PER_REQUEST, true);
    foreach ($chunkedArray as $dataChunk) {
        $preparedData[] = formatRequestBody($dataChunk);
    }

    return $preparedData;
}

function formatRequestBody(array $data): array
{
    $formatedData = [];
    foreach ($data as $id => $qnt) {
        $formatedData[] = [
            'id' => $id,
            'stock_quantity' => $qnt
        ];
    }
    return ['update' => $formatedData];
}
