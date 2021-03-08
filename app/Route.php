<?php

namespace app;

class Route
{
    public $url;
    public $get_str;
    public $essence;
    public $action;
    public $model_url;
    public $controller_url;
    public $view_url;

    public function __construct()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $this->url = trim($url[0], '/');
        $this->get_str = $url[1];

        $url = explode('/', $this->url);

        if (isset($url[0]) && strlen($url[0]) > 0) {
            $this->essence = $url['0'];
            $path = SITE_ROOT . DIRECTORY_SEPARATOR . 'local' . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $this->essence;
            $this->model_url = $path . DIRECTORY_SEPARATOR . 'model.php';
            $this->controller_url = $path . DIRECTORY_SEPARATOR . 'controller.php';
            $this->view_url = $path . DIRECTORY_SEPARATOR . 'view.php';

            if (!file_exists($this->model_url)) {
                header('Location: ' . SITE_URL_404);
            }

            if (isset($url[1]) && strlen($url[1]) > 0) {
                $this->action = $url['1'];
            } else {
                $this->action = 'main';
            }
        } else {
            $path = SITE_ROOT . DIRECTORY_SEPARATOR . 'local' . DIRECTORY_SEPARATOR .'modules' . DIRECTORY_SEPARATOR . 'main';
            $this->model_url = $path . DIRECTORY_SEPARATOR . 'model.php';
            $this->controller_url = $path . DIRECTORY_SEPARATOR . 'controller.php';
            $this->view_url = $path . DIRECTORY_SEPARATOR . 'view.php';
            $this->action = 'main';
        }
    }
}