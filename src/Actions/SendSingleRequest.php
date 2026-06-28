<?php

declare(strict_types=1);

namespace Actions;

use Objects\WcUpdateRequestBody;

final class SendSingleRequest
{
    public function __invoke(WcUpdateRequestBody $body): string
    {
        $ch = new PrepareRequest()($body);

        $response = \curl_exec($ch);

        return \json_encode(\json_decode($response), JSON_PRETTY_PRINT);
    }
}
