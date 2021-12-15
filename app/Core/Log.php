<?php

namespace App\Core;

use DateTime;

class Log {

    public static function print(?string $message) {
        $logsFile = storage_path('logs/app.log');
        $date = new DateTime();
        $now = $date->format('Y-m-d H:i:s');
        file_put_contents($logsFile, "[$now] $message \n", FILE_APPEND);
    }
}