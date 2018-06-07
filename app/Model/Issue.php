<?php

namespace App\Model;

class Issue
{
    public $id;
    public $number;
    public $title;
    /** @var User */
    public $user;
    /** @var Label[] */
    public $labels = [];
    public $date;
    public $comments;
    public $comments_url;
    public $created_at;

    /**
     * Create entity
     */
    public function __construct($data)
    {
        $this->id = $data['id'] ?? null;
        $this->number = $data['number'] ?? null;
        $this->title = $data['title'] ?? null;
        if (!empty($data['user'])) {
            $this->user = new User($data['user']);
        }
        if (!empty($data['labels']) && is_array($data['labels'])) {
            foreach ($data['labels'] as $label) {
                $this->labels[] = new Label($label);
            }
        }
        $this->state = $data['state'] ?? null;
        $this->date = $data['date'] ?? null;
        $this->comments = $data['comments'] ?? null;
        if (!empty($data['number'])) {
            $this->comments_url = route('issue_comments', ['num' => $data['number']]);
        }
        $this->created_at = $data['created_at'] ?? null;
    }
}