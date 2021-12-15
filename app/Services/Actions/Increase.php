<?php

namespace App\Services\Actions;

class Increase {

    private $difference = 0;

    public function process($nominal) {
        $res = $nominal * 10;
        $this->difference = $res - $nominal;
        return $res;
    }

    public function getDiff() {
        return $this->difference;
    }
}