<?php

namespace App\Model;

class IssueMapper extends HttpMapper
{
    /**
     * Fetch a list of issues
     *
     * @param array $params Fetch parameters
     *
     * @return Issue[]
     */
    public function fetch(array $params = [])
    {
        $res = $this->client->request('GET', env('GITHUB_REPOSITORY').'/issues' );

        $decoded = $this->decodeResponse($res);
        if (empty($decoded)) {
            return [];
        }

        $issues = [];
        foreach ($decoded as $item) {
            $issues[] = new Issue($item);
        }

        return $issues;
    }

    /**
     * Get single issue by it's number
     *
     * @param int $number
     *
     * @return Issue|false
     */
    public function getByNumber($number)
    {
        $res = $this->client->request('GET', env('GITHUB_REPOSITORY').'/issues/'.$number );

        $decoded = $this->decodeResponse($res);
        if (empty($decoded)) {
            return false;
        }

        return new Issue($decoded);
    }
}