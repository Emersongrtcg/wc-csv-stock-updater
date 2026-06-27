<?php

declare(strict_types=1);

use const ID_COLUMN_TITLE as ID;
use const STOCK_COLUMN_TITLE as STOCK;

final readonly class GetStocksFromCsv {
    private string $filePath;
    /**
     * @var resource|false
     */
    private $csv;
    private array $header;

    /**
     * @return array<int, int>
     */
    public function __invoke(string $filePath): array
    {
        $this->filePath = $filePath;

        $this->openCsv();

        $stocks = [];
        while ($line = $this->getNextLine()) {
            $line = array_combine($this->header, $line);

            $id = $line[ID];
            if (isset($stocks[$id])) {
                throw new Exception(
                    "The id $id apperas more than once in $this->filePath."
                );
            }

            $stocks[$id] = (int) $line[STOCK];
        }

        return $stocks;
    }

    private function openCsv(): void
    {
        $this->csv = @fopen(FILES_DIR . DIRECTORY_SEPARATOR . $this->filePath, 'r');
        if ($this->csv === false) {
            throw new Exception("Failed to load $this->filePath.");
        }

        $this->header = $this->getNextLine();
        if (!$this->hasValidHeader()) {
            throw new Exception(
                "$this->filePath needs to have a header with at least the columns " . 
                ID . ' and ' . STOCK . '.'
            );
        }
    }

    private function getNextLine(): array|false
    {
        //@ for the deprecation warning in PHP 8.4 for the use of the default
        //value of the escape argument.
        return @fgetcsv($this->csv, escape: "\\");
    }

    private function hasValidHeader(): bool
    {
        if (!array_any($this->header, fn($head) => $head === ID)) {
            return false;
        }
        if (!array_any($this->header, fn($head) => $head === STOCK)) {
            return false;
        }
        return true;
    }

    private function __destruct()
    {
        fclose($this->csv);
    }
}
