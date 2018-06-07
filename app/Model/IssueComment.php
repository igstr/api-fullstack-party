<?php

namespace App\Model;

class IssueComment
{
    public $id;
    /** @var User */
    public $user;
    public $created_at;
    public $body;

    /**
     * Create entity
     */
    public function __construct($data)
    {
        $this->id = $data['id'] ?? null;
        if (!empty($data['user'])) {
            $this->user = new User($data['user']);
        }
        $this->created_at = $data['created_at'] ?? null;
        $this->body = $data['body'] ?? null;
    }
}
