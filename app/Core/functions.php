<?php 
use App\Interfaces\IEvent;
use App\Core\Processes\EventListenProcess;

if (!function_exists('event')) {
    function event(IEvent $event, $data = null) {
        (new EventListenProcess($event, $data))->run();
    }
}