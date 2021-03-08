<?php

namespace app;

require_once 'config.php';
require_once 'autoload.php';

class App
{
    private $route;
    function __construct()
    {
        $this->route = new Route();
    }

    function start()
    {
        require_once ($this->route->controller_url);
        $action = 'action_' . $this->route->action;

        if (function_exists($action)) {
            $action();
        } else {
            header('Location: ' . SITE_URL_404);
        }
    }
}