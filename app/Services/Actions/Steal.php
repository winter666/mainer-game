<?php

namespace App\Services\Actions;

class Steal extends Action implements IAction {

    public function process(array $data) {
        $nominal = $data['nominal'];
        $res = floor($nominal / 2);
        $this->difference = $nominal - $res;
        return $res;
    }

}