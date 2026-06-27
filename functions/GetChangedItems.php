<?php

declare(strict_types=1);

/**
 * @return array<int, int>
 */
function getChangedItems(array $oldStock, array $newStock): array
{
    $errorMesage = checkIfItemsAreEqual($oldStock, $newStock);
    if ($errorMesage !== '') {
        throw new Exception($errorMesage);
    }

    $changedItems = [];
    foreach ($oldStock as $id => $oldQnt) {
        $newQnt = $newStock[$id];
        if ($oldQnt === $newQnt) {
            continue;
        }

        $changedItems[$id] = $newQnt;
    }

    return $changedItems;
}

function checkIfItemsAreEqual($oldStock, $newStock): string
{
    $mesage = '';

    $itemsOnlyInOldStock = array_diff_key($oldStock, $newStock);
    if (!empty($itemsOnlyInOldStock)) {
        $itemsList = implode("\n", array_keys($itemsOnlyInOldStock));
        $mesage .= "\nThe following items are present only in the old stock:\n$itemsList\n";
    }

    $itemsOnlyInNewStock = array_diff_key($newStock, $oldStock);
    if (!empty($itemsOnlyInNewStock)) {
        $itemsList = implode("\n", array_keys($itemsOnlyInNewStock));
        $mesage .= "\nThe following items are present only in the new stock:\n$itemsList\n";
    }

    return $mesage;
}
