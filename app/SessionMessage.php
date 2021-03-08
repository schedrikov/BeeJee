<?php

namespace app;

class SessionMessage
{
    function set($msg)
    {
        $_SESSION['msg'] = $msg;
    }

    function show()
    {
        if (strlen($_SESSION['msg']) > 0) {
            echo '<div class="container border session-message bg-success" ><p class="text-white">' . $_SESSION['msg'] . '</p></div>';
            unset($_SESSION['msg']);
        }
    }
}