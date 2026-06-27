<?php

declare(strict_types=1);

/**
 * Formats the changed items list in the way WooCommerce API needs to be formated.
 */
final readonly class GetRequestBodies
{
    /**
     * @var array{array{update: array{array{id: int, stock_quantity: int}}}}
     */
    private array $requestBodies;

    /**
     * @return array{array{update: array{array{id: int, stock_quantity: int}}}} The
     * list of request bodies, ready to be JSON-parsed.
     */
    public function __invoke(array $changedItems): array
    {
        $chunkedArray = array_chunk($changedItems, MAX_PRODUCTS_PER_REQUEST, true);
        foreach ($chunkedArray as $dataChunk) {
            $this->requestBodies[] = $this->formatRequestBody($dataChunk);
        }

        return $this->requestBodies;
    }

    /**
     * @param array $data
     * @return array{update: array{array{id: int, stock_quantity: int}}}
     */
    private function formatRequestBody(array $data): array
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
}
