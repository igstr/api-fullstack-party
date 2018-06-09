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
        $url = 'repos/'.env('GITHUB_REPOSITORY').'/issues';
        $res = $this->client->request('GET', $url, [ 'query' => $params ]);

        $decoded = $this->client->decodeJsonResponse($res);
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
        $url = 'repos/'.env('GITHUB_REPOSITORY').'/issues/'.$number;
        $res = $this->client->request('GET', $url );

        $decoded = $this->client->decodeJsonResponse($res);
        if (empty($decoded)) {
            return false;
        }

        return new Issue($decoded);
    }
}