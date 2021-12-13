<?php

namespace App\Entities;

class Player {
    public $name;
    private $score;
    private $step_score = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function countScore($score) {
        $this->step_score[] = $score;
        $this->score += $score;
    }

    public function getScoreList() {
        return $this->step_score;
    }
    
    public function getScore() {
        return $this->score;
    }
}