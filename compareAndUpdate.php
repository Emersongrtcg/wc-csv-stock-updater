<?php

declare(strict_types=1);

require_once 'constants.php';
require_once 'autoload.php';
require_once 'config.php';
require_once 'functions/UpdateStocks.php';

$oldStock = new GetStocksFromCsv()(OLD_DATA_FILE_NAME);
$newStock = new GetStocksFromCsv()(NEW_DATA_FILE_NAME);

$changedItems = new GetChangedItems()($oldStock, $newStock);
if (empty($changedItems)) {
    echo 'The stocks are the same in both files. No product will be updated.';
    exit;
}

updateStocks($changedItems);
