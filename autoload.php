<?php

use const WcCsvStockUpdater\SRC_DIR;

spl_autoload_register(function (string $className): bool {
    if (!str_starts_with($className, 'WcCsvStockUpdater')) {
        return false;
    }

    $classBaseName = str_replace('WcCsvStockUpdater\\', '', $className);
    $fileSubPath = str_replace('\\', DIRECTORY_SEPARATOR, $classBaseName);

    $filePath = SRC_DIR . DIRECTORY_SEPARATOR . $fileSubPath . '.php';
    if (!file_exists($filePath)) {
        return false;
    }

    require $filePath;
    return true;
});
