<?php

declare(strict_types=1);

use Actions\GetStocksFromCsv;
use Actions\UpdateStocks;

require_once 'constants.php';
require_once 'autoload.php';
require_once 'config.php';

$stocks = new GetStocksFromCsv()(STOCK_FILE_NAME);

new UpdateStocks()($stocks);
