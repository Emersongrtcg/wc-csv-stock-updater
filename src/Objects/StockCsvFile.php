<?php

declare(strict_types=1);

namespace WcCsvStockUpdater\Objects;

use Exception;
use const WcCsvStockUpdater\FILES_DIR;
use const WcCsvStockUpdater\ID_COLUMN_TITLE as ID;
use const WcCsvStockUpdater\STOCK_COLUMN_TITLE as STOCK;

final class StockCsvFile
{
    /**
     * @var resource|false
     */
    private $csv;
    private readonly array $header;

    public function __construct(private string $filePath)
    {
        $this->openCsv();
        $this->extractHeader();
    }

    private function openCsv(): void
    {
        $this->csv = @\fopen(FILES_DIR . DIRECTORY_SEPARATOR . $this->filePath, 'r');

        if ($this->csv === false) {
            throw new Exception("Failed to load $this->filePath.");
        }
    }

    private function extractHeader(): void
    {
        $header = $this->nextLineWithouHeader();
        if ($header === false) {
            throw new Exception(
                'Failed to obtain the header. Maybe your file is empty.'
            );
        }

        if (
            !\array_any($header, fn($head) => $head === ID) ||
            !\array_any($header, fn($head) => $head === STOCK)
        ) {
            throw new Exception(
                "$this->filePath needs to have a header with at least the columns " .
                ID . ' and ' . STOCK . '.'
            );
        }

        $this->header = $header;
    }

    private function nextLineWithouHeader(): array|false
    {
        //@ for the deprecation warning in PHP 8.4+ for the use of the default
        //value of the escape argument.
        return @\fgetcsv($this->csv, escape: "\\");
    }

    public function nextLine(): array|false
    {
        $line = $this->nextLineWithouHeader();
        return $line ? \array_combine($this->header, $line) : false;
    }

    private function __destruct()
    {
        \fclose($this->csv);
    }
}
