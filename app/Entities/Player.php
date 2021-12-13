<?php

namespace App\Entities;

class Player {
    public $name;
    private $score;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}