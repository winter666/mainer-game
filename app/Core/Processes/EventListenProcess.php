<?php

namespace App\Core\Processes;

use App\Core\Interfaces\IProcess;
use App\Interfaces\IEvent;
use App\Providers\EventProvider;

class EventListenProcess implements IProcess {

    private $event;
    private $data;

    public function __construct(IEvent $event, $data = null) {
        $this->event = $event;
        $this->data = $data;
    }

    public function run() {
        $eventStack = EventProvider::callStack();
        $handlerClass = $eventStack[get_class($this->event)];
        $handlerObject = new $handlerClass($this->data);
        $handlerObject->handle();        
    }

}