<?php

declare(strict_types=1);

namespace WcCsvStockUpdater\Objects;

final class WcUpdateRequestBody
{
    /**
     * @var array{array{id: int, stock_quantity: int}}
     */
    private array $itemsToUpdate;

    public function __construct(array $dataToFormat)
    {
        foreach ($dataToFormat as $id => $qnt) {
            $this->itemsToUpdate[] = [
                'id' => $id,
                'stock_quantity' => $qnt
            ];
        }
    }

    public function json(): string
    {
        return json_encode(['update' => $this->itemsToUpdate]);
    }
}
