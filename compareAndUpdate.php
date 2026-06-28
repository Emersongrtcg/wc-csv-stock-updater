<?php

declare(strict_types=1);

use WcCsvStockUpdater\Actions\GetChangedItems;
use WcCsvStockUpdater\Actions\GetStocksFromCsv;
use WcCsvStockUpdater\Actions\UpdateStocks;
use const WcCsvStockUpdater\NEW_DATA_FILE_NAME;
use const WcCsvStockUpdater\OLD_DATA_FILE_NAME;

require_once 'constants.php';
require_once 'autoload.php';
require_once 'config.php';

$oldStock = new GetStocksFromCsv()(OLD_DATA_FILE_NAME);
$newStock = new GetStocksFromCsv()(NEW_DATA_FILE_NAME);

$changedItems = new GetChangedItems()($oldStock, $newStock);
if (empty($changedItems)) {
    echo 'The stocks are the same in both files. No product will be updated.' . PHP_EOL;
    exit;
}

new UpdateStocks()($changedItems);
