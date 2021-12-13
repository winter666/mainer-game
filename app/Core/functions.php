<?php 
use App\Interfaces\IEvent;
use App\Core\Processes\EventListenProcess;

if (!function_exists('event')) {
    function event(IEvent $event, $data = null, $needReturn = false) {
        return (new EventListenProcess($event, $data,  $needReturn))->run();
    }
}


if (!function_exists('throw_if')) {
    function throw_if($expression, \Exception $e) {
        if ($expression) throw $e;
    }
}

if (!function_exists('storage_path')) {
    function storage_path(string $fileName): string {
        return $_SERVER['DOCUMENT_ROOT'] . "/storage/" . $fileName;
    }
}