<?php

spl_autoload_register(function (string $className): bool {
    $adjustedClassName = str_replace('\\', DIRECTORY_SEPARATOR, $className);

    $filename = SRC_DIR . DIRECTORY_SEPARATOR . $adjustedClassName;
    if (!file_exists($filename)) {
        return false;
    }

    require $filename;
    return true;
});
