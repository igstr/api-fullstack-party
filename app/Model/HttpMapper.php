<?php

namespace App\Model;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Response;

class HttpMapper
{
    /** @var HttpClient */
    protected $client;

    /**
     * Create data mapper
     */
    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * Decode API response
     *
     * @param Response $res Response to decode
     * @throws UnexpectedValueException
     *
     * @return mixed
     */
    protected function decodeResponse(Response $res)
    {
        if ($res->getStatusCode() != 200) {
            throw new \UnexpectedValueException('Error while trying to fetch data');
        }

        $decoded = json_decode($res->getBody(), true);

        if (is_null($decoded)) {
            throw new \UnexpectedValueException('Cannot decode response data');
        }

        return $decoded;
    }
}

