<?php

namespace App\Services\Actions;

class Decrease extends Action implements IAction {

    public function process(array $data) {
        $nominal = $data['nominal'];
        $res = floor($nominal / 10);
        $this->difference = $nominal - $res;
        return $res;
    }

}