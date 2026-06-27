<?php

declare(strict_types=1);

require_once 'constants.php';
require_once 'autoload.php';
require_once 'config.php';
require_once 'functions/GetStocksFromCsv.php';
require_once 'functions/UpdateStocks.php';

$stocks = getStocksFromCsv(STOCK_FILE_NAME);

updateStocks($changedItems);
