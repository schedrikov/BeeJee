<?php

ob_start();
session_start();

define('SITE_ROOT', __DIR__);

require_once SITE_ROOT . '/app/App.php';

$app = new app\App();
$app->start();

ob_end_flush();