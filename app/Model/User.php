<?php

namespace App\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User implements AuthenticatableContract
{
    use Authenticatable;

    public $id;
    public $login;
    public $avatar_url;

    /**
     * Create entity
     */
    public function __construct($data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->login = $data['login'] ?? null;
        $this->avatar_url = $data['avatar_url'] ?? null;
    }
}