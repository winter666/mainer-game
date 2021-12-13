<?php 
use App\Interfaces\IEvent;
use App\Core\Processes\EventListenProcess;

if (!function_exists('event')) {
    function event(IEvent $event, $data = null) {
        (new EventListenProcess($event, $data))->run();
    }
}


if (!function_exists('throw_if')) {
    function throw_if($expression, \Exception $e) {
        if ($expression) throw $e;
    }
}