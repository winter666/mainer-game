<?php

namespace App\Services\Actions;

class Increase extends Action implements IAction{

    public function process(array $data) {
        $nominal = $data['nominal'];
        $res = $nominal * 10;
        $this->difference = $res - $nominal;
        return $res;
    }

}