<?php

namespace app;

class View
{
    public function show($url, $data)
    {
        require SITE_ROOT . DIRECTORY_SEPARATOR . 'local' . DIRECTORY_SEPARATOR . 'theme' . DIRECTORY_SEPARATOR .'head.php';

        $path = SITE_ROOT . $url;
        if (file_exists($path)) {
            require SITE_ROOT . $url;
        } else {
            die('View not found: ' . $url);
        }
        require SITE_ROOT . DIRECTORY_SEPARATOR . 'local' . DIRECTORY_SEPARATOR . 'theme' . DIRECTORY_SEPARATOR . 'footer.php';
    }
}