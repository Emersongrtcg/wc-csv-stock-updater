<?php

declare(strict_types=1);

namespace WcCsvStockUpdater\Actions;

use Exception;
use WcCsvStockUpdater\Objects\StockCsvFile;
use const WcCsvStockUpdater\FILES_DIR;
use const WcCsvStockUpdater\ID_COLUMN_TITLE as ID;
use const WcCsvStockUpdater\STOCK_COLUMN_TITLE as STOCK;

final class GetStocksFromCsv
{
    /**
     * @var array<int, int>
     */
    private array $stocks;
    private readonly StockCsvFile $csv;
    private readonly string $fileName;

    /**
     * @return array<int, int>
     */
    public function __invoke(string $fileName): array
    {
        $this->csv = new StockCsvFile(FILES_DIR . DIRECTORY_SEPARATOR . $fileName);
        $this->fileName = $fileName;

        while ($line = $this->csv->nextLine()) {
            $this->insertLineInStocks($line);
        }

        return $this->stocks;
    }

    private function insertLineInStocks(array $line): void
    {
        $id = $line[ID];
        if (\isset($this->stocks[$id])) {
            throw new Exception(
                "The id $id appears more than once in $this->fileName."
            );
        }

        $this->stocks[$id] = (int) $line[STOCK];
    }
}
