<?php

namespace App\Model;

class UserMapper extends HttpMapper
{
    /**
     * Fetch a user by his access token
     *
     * @param string $token User access token
     *
     * @return User|null
     */
    public function fetchByToken($token)
    {
        $url = env('GITHUB_API_URL').'/user';
        $query = [ 'access_token' => $token ];

        $res = $this->client->request('GET', $url, [ 'query' => $query ]);

        $decoded = $this->decodeResponse($res);
        if (empty($decoded)) {
            return null;
        }

        return new User($decoded);
    }
}