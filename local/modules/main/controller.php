<?php

function action_main()
{
    $data['viewTitle'] = 'Тест beejee';

    $model = new \local\modules\task\Task();
    $total_count = $model->getCount();

    $current_page = (int)$_GET['page'];
    $current_page = ($current_page) ? : 1;

    $pagination = new app\Pagination($total_count, 3, $current_page);
    $data['pagination'] = $pagination->show();

    $sort_param = [
        0 => [
            'name' => 'Без сортировки',
            'sort' => ''
        ],
        1 => [
            'name' => 'По имени &darr;',
            'sort' => ' ORDER BY `name`',
        ],
        2 => [
            'name' => 'По имени &uarr;',
            'sort' => ' ORDER BY `name` DESC',
        ],
        3 => [
            'name' => 'По email &darr;',
            'sort' => ' ORDER BY `email`',
        ],
        4 => [
            'name' => 'По email &uarr;',
            'sort' => ' ORDER BY `email` DESC',
        ],
        5 => [
            'name' => 'По статусу &darr;',
            'sort' => ' ORDER BY `status`',
        ],
        6 => [
            'name' => 'По статусу &uarr;',
            'sort' => ' ORDER BY `status` DESC',
        ],
    ];

    $sort = new app\SortFilters($sort_param);
    $data['sort'] = $sort->show();

    $data['tasks'] = $model->getAll($sort->getSort(), $pagination->getLimit());

    $view = new \app\View();
    $view->show('/local/modules/main/view.php', $data);
}
