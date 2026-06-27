<?php

declare(strict_types=1);

use Objects\WcUpdateRequestBody;

final readonly class SendMultipleRequests
{
    private CurlMultiHandle $cmh;

    public function __construct()
    {
        $this->cmh = curl_multi_init();
    }

    /**
     * @param array{WcUpdateRequestBody} $bodies
     */
    public function __invoke(array $bodies): string
    {
        foreach ($bodies as $body) {
            $ch = new PrepareRequest()($body);
            curl_multi_add_handle($this->cmh, $ch);
        }

        $responses = $this->executeMultiHandle();

        return $responses;
    }

    private function executeMultiHandle(): string
    {
        $responses = '';
        do {
            curl_multi_exec($this->cmh, $running);
            $responses .= $this->getMessages();
        } while ($running);

        return $responses;
    }

    private function getMessages(): string
    {
        $message = curl_multi_info_read($this->cmh);
        if (false === $message) {
            return '';
        }

        $response = curl_multi_getcontent($message['handle']);

        return json_encode(json_decode($response), JSON_PRETTY_PRINT) . PHP_EOL;
    }

    public function __destruct()
    {
        curl_multi_close($this->cmh);
    }
}
