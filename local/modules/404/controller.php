<?php

function action_main()
{
    header("HTTP/1.0 404 Not Found");

    $data['viewTitle'] = '404 - Тест beejee';

    $view = new \app\View();
    $view->show('/local/modules/404/view.php', $data);
}