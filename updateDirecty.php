<?php

declare(strict_types=1);

require_once 'constants.php';
require_once 'config.php';
require_once 'functions/getStocksFromCsv.php';
require_once 'functions/updateStocks.php';

$stocks = getStocksFromCsv(STOCK_FILE_NAME);

updateStocks($changedItems);
