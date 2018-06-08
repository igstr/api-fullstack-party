<?php

namespace App\Model;

class IssueCommentMapper extends HttpMapper
{
    /**
     * Fetch data
     *
     * @param int $number Number of the issue
     * @param array $params Fetch parameters
     *
     * @return IssueComment[]
     */
    public function fetch($number, array $params = [])
    {
        $url = env('GITHUB_REPOSITORY').'/issues/'.$number.'/comments';
        $res = $this->client->request('GET', $url, [ 'query' => $params ]);

        $decoded = $this->decodeResponse($res);
        if (empty($decoded)) {
            return [];
        }

        $comments = [];
        foreach ($decoded as $item) {
            $comments[] = new IssueComment($item);
        }

        return $comments;
    }
}