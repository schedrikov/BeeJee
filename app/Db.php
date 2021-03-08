<?php

namespace app;

class Db
{
    private $connect;

    /**
     * Db constructor.
     * @param $host
     * @param $user
     * @param $pass
     * @param $db
     */
    function __construct($host, $user, $pass, $db)
    {
        $this->connect = @mysqli_connect($host, $user, $pass, $db);
        if (!$this->connect) {
            die('Connect error: ' . mysqli_connect_error());
        }
    }

    function getConnect()
    {
        return $this->connect;
    }
}