<?php

declare(strict_types=1);

use const ID_COLUMN_TITLE as ID;
use const STOCK_COLUMN_TITLE as STOCK;

/**
 * @return array<int, int>
 */
function getStocksFromCsv(string $filePath): array
{
    [$csv, $header] = openCsv($filePath);

    $stocks = [];
    while ($line = getNextLine($csv)) {
        $line = array_combine($header, $line);

        $id = $line[ID];
        if (isset($stocks[$id])) {
            throw new Exception("The id $id apperas more than once in $filePath.");
        }

        $stocks[$id] = (int) $line[STOCK];
    }

    fclose($csv);

    return $stocks;
}

/**
 * @return array{csv: resource, header: array}
 */
function openCsv(string $filePath): array
{
    $csv = @fopen("files/$filePath", 'r');
    if ($csv === false) {
        throw new Exception("Failed to load $filePath.");
    }

    $header = getNextLine($csv);
    if (!isValidHeader($header)) {
        throw new Exception(
            "$filePath needs to have a header with at least the columns " . 
            ID . ' and ' . STOCK . '.'
        );
    }

    return ['csv' => $csv, 'header' => $header];
}

/**
 * @param resource $csv
 */
function getNextLine($csv): array|false
{
    //@ for the deprecation warning in PHP 8.4 for the use of the default value
    //of the escape argument.
    return @fgetcsv($csv, escape: "\\");
}

function isValidHeader(array $header): bool
{
    if (!array_any($header, fn($head) => $head === ID)) {
        return false;
    }
    if (!array_any($header, fn($head) => $head === STOCK)) {
        return false;
    }
    return true;
}
