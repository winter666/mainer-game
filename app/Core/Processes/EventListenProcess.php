<?php

namespace App\Core\Processes;

use App\Core\Interfaces\IProcess;
use App\Interfaces\IEvent;
use App\Providers\EventProvider;

class EventListenProcess implements IProcess {

    private $event;
    private $data;
    private $need_return_data;

    public function __construct(IEvent $event, $data = null, $needReturnData = false) {
        $this->event = $event;
        $this->data = $data;
        $this->need_return_data = $needReturnData;
    }

    public function run() {
        $eventStack = EventProvider::callStack();
        $handlerClass = $eventStack[get_class($this->event)];
        $handlerObject = new $handlerClass($this->data);
        $result = $handlerObject->handle();
        if ($this->need_return_data) return $result;
    }

}