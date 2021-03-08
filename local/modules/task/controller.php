<?php

function action_add()
{
    $data['viewTitle'] = 'Добавление задачи - Test beejee';

    if (isset($_POST['addtask']) && $_POST['addtask'] == 1) {

        $form_errors = [
            'name' => 'Введите поле - Имя<br>',
            'email' => 'Введите поле - Email<br>',
            'text' => 'Введите поле - Текст задачи<br>'
        ];

        $error_text = '';
        $task_data = [];

        foreach ($form_errors as $k => $v) {
            if (strlen($_POST[$k]) > 0) {
                $task_data[$k] = trim($_POST[$k]);

                if ($k == 'email' && !filter_var($task_data[$k], FILTER_VALIDATE_EMAIL)) {
                    $error_text .= 'Поле Email указано неверно<br>';
                }
            } else {
                $error_text .= $v;
            }
        }

        if (strlen($error_text) == 0) {
            $model = new \local\modules\task\Task();
            $result = $model->add($task_data);
            if ($result === true) {
                $msg = new \app\SessionMessage();
                $msg->set('Задача успешно добавлена!');
                session_write_close();

                header('Location: ' . SITE_URL . '');
            } else {
                $error_text .= 'Ошибка добавления записи в БД';
            }
        }

        $data['error_text'] = $error_text;
        $data['form_data'] = $task_data;
    }

    $view = new \app\View();
    $view->show('/local/modules/task/view_add.php', $data);
}

function action_edit()
{
    $data['viewTitle'] = 'Редактирование задачи - Test beejee';

    if ($_SESSION['admin'] == 0) {
        $view = new \app\View();
        $view->show('/local/modules/user/view_access_denied.php', $data);
        return;
    }

    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $model = new \local\modules\task\Task();
        $task = $model->get($id);

        if ($task !== false) {

            if (isset($_POST['savetask']) && $_POST['savetask'] == 1) {

                $form_errors = [
                    'text' => 'Введите поле - Текст задачи<br>',
                    'status' => 'check'
                ];

                $error_text = '';
                $task_data = [];

                foreach ($form_errors as $k => $v) {
                    if (strlen($_POST[$k]) > 0 || $v == 'check') {
                        if ($v == 'check') {
                            $task_data[$k] = (isset($_POST[$k])) ? 1 : 0;
                        } else {
                            $task_data[$k] = trim($_POST[$k]);
                        }
                    } else {
                        $error_text .= $v;
                    }
                }

                if ($task['text'] !== $task_data['text']) {
                    $task_data['admin_edit'] = 1;
                }

                $model = new \local\modules\task\Task();
                $result = $model->update($id, $task_data);

                if ($result === true) {
                    $msg = new \app\SessionMessage();
                    $msg->set('Задача успешно отредактирована!');
                    session_write_close();
                    header('Location: ' . SITE_URL . '');
                } else {
                    $error_text .= 'Ошибка обновления записи в БД';
                }

                $data['error_text'] = $error_text;
            }

            $data['form_data'] = $task;

            $view = new \app\View();
            $view->show('/local/modules/task/view_edit.php', $data);

            return;
        }
    }

    $view = new \app\View();
    $view->show('/local/modules/task/view_task_not_found.php', $data);
}
