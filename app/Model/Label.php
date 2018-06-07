<?php

namespace App\Model;

class Label
{
    public $id;
    public $name;
    public $color;

    /**
     * Create entity
     */
    public function __construct($data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->color = $data['color'] ?? null;
    }
}
