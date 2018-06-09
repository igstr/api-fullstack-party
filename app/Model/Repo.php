<?php

namespace App\Model;

class Repo
{
    public $id;
    public $name;
    public $description;
    public $open_issues;

    /**
     * Create entity
     */
    public function __construct($data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->open_issues = $data['open_issues'] ?? null;
    }
}