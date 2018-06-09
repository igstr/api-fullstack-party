<?php

namespace App\Http;

use GuzzleHttp\Client as BaseClient;
use GuzzleHttp\Psr7\Response;

class Client extends BaseClient
{
    /**
     * Decode JSON response
     *
     * @param Response $res Response to decode
     * @throws UnexpectedValueException
     *
     * @return mixed
     */
    public function decodeJsonResponse(Response $res)
    {
        if ($res->getStatusCode() == 401) {
            throw new \UnexpectedValueException('Unauthorized');
        }

        if ($res->getStatusCode() != 200) {
            throw new \UnexpectedValueException('Unexpected HTTP status code');
        }

        $decoded = json_decode($res->getBody(), true);

        if (is_null($decoded)) {
            throw new \UnexpectedValueException('Cannot decode response data');
        }

        return $decoded;
    }
}