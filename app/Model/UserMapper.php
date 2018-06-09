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
        $query = [ 'access_token' => $token ];
        $res = $this->client->request('GET', 'user', [ 'query' => $query ]);

        $decoded = $this->client->decodeJsonResponse($res);
        if (empty($decoded)) {
            return null;
        }

        return new User($decoded);
    }
}