<?php

namespace App\Model;

use App\Http\Client as HttpClient;

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
}

