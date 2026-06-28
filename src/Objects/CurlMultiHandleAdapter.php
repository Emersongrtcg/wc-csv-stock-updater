<?php

declare(strict_types=1);

namespace WcCsvStockUpdater\Objects;

use CurlHandle;
use CurlMultiHandle;

final class CurlMultiHandleAdapter
{
    public private(set) string $responses = '';
    private readonly CurlMultiHandle $cmh;

    public function __construct()
    {
        $this->cmh = \curl_multi_init();
    }

    public function addHandle(CurlHandle $ch): void
    {
        \curl_multi_add_handle($this->cmh, $ch);
    }

    public function execute(): void
    {
        do {
            \curl_multi_exec($this->cmh, $running);
            $this->responses .= $this->getMessages();
        } while ($running);
    }

    private function getMessages(): string
    {
        $message = \curl_multi_info_read($this->cmh);
        if (false === $message) {
            return '';
        }

        $response = \curl_multi_getcontent($message['handle']);

        return \json_encode(\json_decode($response), JSON_PRETTY_PRINT) . PHP_EOL;
    }

    public function __destruct()
    {
        \curl_multi_close($this->cmh);
    }
}
