<?php

namespace App\Model;

class IssueCommentMapper extends HttpMapper
{
    /**
     * Fetch data
     *
     * @param int $number
     *
     * @return IssueComment[]
     */
    public function fetch($number)
    {
        $url = env('GITHUB_REPOSITORY').'/issues/'.$number.'/comments';
        $res = $this->client->request('GET', $url );

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