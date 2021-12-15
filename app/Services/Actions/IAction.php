<?php

namespace App\Services\Actions;

interface IAction {

    public function process(array $data);

    public function getDiff();
}