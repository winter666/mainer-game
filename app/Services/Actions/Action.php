<?php

namespace App\Services\Actions;

class Action implements IAction {

    protected $difference;

    public function process(array $data) {

    }

    public function getDiff() {
        return $this->difference;
    }
}