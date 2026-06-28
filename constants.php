<?php

namespace WcCsvStockUpdater;

//WooCommerce batch update has a limit of 100 products by request.
const MAX_PRODUCTS_PER_REQUEST = 100;

const SRC_DIR = __DIR__ . DIRECTORY_SEPARATOR . 'src';
const FILES_DIR = __DIR__ . DIRECTORY_SEPARATOR . 'files';
