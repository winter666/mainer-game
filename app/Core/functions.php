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

if (!function_exists('sources_path')) {
    function sources_path(string $fileName): string {
        return $_SERVER['DOCUMENT_ROOT'] . "/sources/" . $fileName;
    }
}

if (!function_exists('template_path')) {
    function template_path(string $fileName): string {
        return sources_path("templates/" . $fileName);
    }
}

if (!function_exists('lock_dir')) {
    function in_lock_dir(string $fileName): string {
        return storage_path('locks/' . $fileName);
    }
}

if (!function_exists('template')) {
    function template(string $name, array $data = []) {
        $path = template_path(str_replace(".", DIRECTORY_SEPARATOR, $name) . ".php");
        throw_if(!file_exists($path), new \Exception("Template $name not found"));
        foreach($data as $varName => $varVal) {
            ${$varName} = $varVal;
        }
        ob_start();
        require $path;
        return ob_get_clean();
    }
}

if (!function_exists('arr_sort')) {
    function arr_sort(&$arr, $field, $flag = "ASC") {
        usort($arr, function($a, $b) use ($field, $flag) {
            if ($a[$field] == $b[$field]) {
                return 0;
            }

            switch ($flag) {
                case "ASC":
                    return ($a[$field] < $b[$field]) ? -1 : 1;
                case "DESC":
                    return ($a[$field] > $b[$field]) ? -1 : 1;
            }
        });
    }
}