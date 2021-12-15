<?php

namespace App\Services\Actions;

class Decrease {

    private $difference = 0;

    public function process($nominal) {
        $res = floor($nominal / 10);
        $this->difference = $nominal - $res;
        return $res;
    }

    public function getDiff() {
        return $this->difference;
    }
}