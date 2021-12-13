<?php 

namespace App\Core;

/**
 * @property $data
 */
class Listener {
    protected $data;

    public function __construct($data) {
        $this->data = $data;
    }

} 