<?php

namespace App\Model;

class RepoMapper extends HttpMapper
{
    /**
     * Fetch data
     *
     * @return Repo[]|false
     */
    public function fetch()
    {
        $url = 'repos/'.env('GITHUB_REPOSITORY');
        $res = $this->client->request('GET', $url);

        $decoded = $this->client->decodeJsonResponse($res);

        return new Repo($decoded);
    }
}