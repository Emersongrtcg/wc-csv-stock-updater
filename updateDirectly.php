<?php

declare(strict_types=1);

use WcCsvStockUpdater\Actions\GetStocksFromCsv;
use WcCsvStockUpdater\Actions\UpdateStocks;
use const WcCsvStockUpdater\STOCK_FILE_NAME;

require_once 'constants.php';
require_once 'autoload.php';
require_once 'config.php';

$stocks = new GetStocksFromCsv()(STOCK_FILE_NAME);

new UpdateStocks()($stocks);
