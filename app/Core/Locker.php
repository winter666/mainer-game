<?php

namespace App\Core;

class Locker {

    private $fullPath;

    public function __construct(string $filename) {
        $this->fullPath = storage_path($filename . ".lock");
    }

    public function lock() {
        if (!file_exists($this->fullPath)) {
            file_put_contents($this->fullPath, time());
        }
    }

    public function unlock() {
        if (!file_exists($this->fullPath)) {
            unlink($this->fullPath);
        }
    }

    public function isLock() {
        return file_exists($this->fullPath);
    }
}