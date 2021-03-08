<h1>Список задач</h1>
<?php if (count($data['tasks']) > 0) { ?>
    <div class="filters-bar">
        <?=$data['sort']; ?>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Имя пользователя</th>
            <th scope="col">Email</th>
            <th scope="col">Текст задачи</th>
            <th scope="col">Статус</th>
            <?php if ($_SESSION['admin'] == 1) { ?>
                <th scope="col">Действие</th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($data['tasks'] as $task) {
            echo '<tr>';
            echo '<th scope="row">' . $task['id'] . '</th>';
            echo '<td>' . $task['name'] . '</td>';
            echo '<td>' . $task['email'] . '</td>';
            echo '<td>' . $task['text'] . '</td>';

            $status = [];
            if ($task['status'] == 1) {
                $status[] = 'Выполнено';
            }

            if ($task['admin_edit'] == 1) {
                $status[] = 'Отредактировано администратором';
            }

            if (count($status) > 0) {
                echo '<td class="text-success">' . implode(' / ', $status) . '</td>';
            } else {
                echo '<td></td>';
            }

            if ($_SESSION['admin'] == 1) {
                echo '<td><a href="' . SITE_URL . '/task/edit/?id=' . $task['id'] . '">Редактировать</a></td>';
            }

            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
    <?= $data['pagination']; ?>
<?php } else { ?>
    <div class="shadow-sm p-3 mb-5 bg-body rounded">Задачи не найдены</div>
<?php } ?>