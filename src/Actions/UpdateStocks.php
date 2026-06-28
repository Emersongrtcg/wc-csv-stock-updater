<?php

declare(strict_types=1);

namespace Actions;

final class UpdateStocks
{
    /**
     * @param array<int, int> $stocks
     */
    public function __invoke(array $stocks)
    {
        $requestBodies = new GetRequestBodies()($stocks);

        $response = new SendRequests()($requestBodies);

        echo $response;
    }
}
