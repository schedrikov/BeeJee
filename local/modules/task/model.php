<?php

namespace local\modules\task;

class Task extends \app\Model
{
    protected $table = 'task';
    protected $rows = ['id', 'name', 'email', 'text', 'status', 'admin_edit'];

}

