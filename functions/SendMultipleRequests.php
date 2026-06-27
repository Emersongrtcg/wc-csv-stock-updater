<?php

declare(strict_types=1);

use Objects\CurlMultiHandleAdapter;
use Objects\WcUpdateRequestBody;

final readonly class SendMultipleRequests
{
    private CurlMultiHandleAdapter $cmh;

    public function __construct()
    {
        $this->cmh = new CurlMultiHandleAdapter();
    }

    /**
     * @param array{WcUpdateRequestBody} $bodies
     */
    public function __invoke(array $bodies): string
    {
        foreach ($bodies as $body) {
            $ch = new PrepareRequest()($body);
            $this->cmh->addHandle($ch);
        }

        $this->cmh->execute();

        return $this->cmh->responses;
    }
}
