<?php

use const WcCsvStockUpdater\SRC_DIR;

spl_autoload_register(function (string $className): bool {
    if (!str_starts_with($className, 'WcCsvStockUpdater')) {
        return false;
    }

    $adjustedClassName = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $fileSubPath = str_replace('WcCsvStockUpdater', 'src', $adjustedClassName);

    $filePath = SRC_DIR . DIRECTORY_SEPARATOR . $fileSubPath;
    if (!file_exists($filePath)) {
        return false;
    }

    require $filePath;
    return true;
});
