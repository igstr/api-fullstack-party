<?php

namespace App\Model;

class Repo
{
    public $id;
    public $open_issues;

    /**
     * Create entity
     */
    public function __construct($data)
    {
        $this->id = $data['id'] ?? null;
        $this->open_issues = $data['open_issues'] ?? null;
    }
}