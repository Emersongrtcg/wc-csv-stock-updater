<?php

declare(strict_types=1);

require_once 'constants.php';
require_once 'config.php';
require_once 'functions/getStocksFromCsv.php';
require_once 'functions/getChangedItems.php';
require_once 'functions/updateStocks.php';

$oldStock = getStocksFromCsv(OLD_DATA_FILE_NAME);
$newStock = getStocksFromCsv(NEW_DATA_FILE_NAME);

$changedItems = getChangedItems($oldStock, $newStock);
if (empty($changedItems)) {
    echo 'The stocks are the same in both files. No product will be updated.';
    exit;
}

updateStocks($changedItems);
