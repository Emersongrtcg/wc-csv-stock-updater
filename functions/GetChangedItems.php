<?php

declare(strict_types=1);

final class GetChangedItems
{
    /**
     * @var array<int, int>
     */
    private array $changedItems;

    /**
     * @param array<int, int> $oldStock
     * @param array<int, int> $newStock
     * @return array<int, int>
     */
    public function __invoke(array $oldStock, array $newStock): array
    {
        $this->assertItemsAreEqual($oldStock, $newStock);

        foreach ($oldStock as $id => $oldQnt) {
            $newQnt = $newStock[$id];
            if ($oldQnt === $newQnt) {
                continue;
            }

            $this->changedItems[$id] = $newQnt;
        }

        return $this->changedItems;
    }

    private function assertItemsAreEqual(array $oldStock, array $newStock): void
    {
        $errorMessage = '';

        $itemsOnlyInOldStock = array_diff_key($oldStock, $newStock);
        if (!empty($itemsOnlyInOldStock)) {
            $itemsList = implode("\n", array_keys($itemsOnlyInOldStock));
            $errorMessage .= "\nThe following items are present only in the old stock:\n$itemsList\n";
        }

        $itemsOnlyInNewStock = array_diff_key($newStock, $oldStock);
        if (!empty($itemsOnlyInNewStock)) {
            $itemsList = implode("\n", array_keys($itemsOnlyInNewStock));
            $errorMessage .= "\nThe following items are present only in the new stock:\n$itemsList\n";
        }

        if ($errorMessage !== '') {
            throw new Exception($errorMessage);
        }
    }
}
