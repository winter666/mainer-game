<?php

namespace App\Services\Actions;

class Steal {

    private $difference = 0;

    public function process($nominal) {
        $res = floor($nominal / 2);
        $this->difference = $nominal - $res;
        return $res;
    }

    public function getDiff() {
        return $this->difference;
    }
}