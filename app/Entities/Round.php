<?php

namespace App\Entities;

class Round {
    private $current = 0;

    public function up() {
        $this->current += 1;
    }

    public function getCurrent() {
        return $this->current;
    }
}