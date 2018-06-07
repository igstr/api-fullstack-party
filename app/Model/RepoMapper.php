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
        $res = $this->client->request('GET', env('GITHUB_REPOSITORY'));

        $decoded = $this->decodeResponse($res);

        return new Repo($decoded);
    }
}