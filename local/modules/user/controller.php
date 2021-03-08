<?php

function action_login()
{
    $data['viewTitle'] = 'Авторизация - Test beejee';

    if (isset($_POST['userlogin']) && $_POST['userlogin'] == 1) {
        $user = 'admin';
        $pass = md5('123');

        $form_errors = [
            'name' => 'Введите Имя<br>',
            'password' => 'Введите пароль<br>',
        ];

        $error_text = '';

        foreach ($form_errors as $k => $v) {
            if (strlen($_POST[$k]) == 0) {
                $error_text .= $v;
            }
        }

        if (strlen($error_text) == 0) {
            if (trim($_POST['name']) == $user && md5(trim($_POST['password'])) == $pass) {
                $_SESSION['admin'] = 1;
            } else {
                $error_text = 'Неправильное сочетание имени и пароля';
            }
        }

        $data['error_text'] = $error_text;
    }

    if (isset($_POST['userlogout']) && $_POST['userlogout'] == 1) {
        $_SESSION['admin'] = 0;
    }

    $data['admin'] = ($_SESSION['admin'] == 1) ? 1 : 0;

    $view = new \app\View();
    $view->show('/local/modules/user/view.php', $data);
}
