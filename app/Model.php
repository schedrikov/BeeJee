<?php

namespace app;

class Model
{
    protected $db;
    protected $table = "table";
    protected $rows = [];

    public function __construct() {
        $db_connect = new \app\Db(DB_HOST, DB_USER, DB_PASS, DB_BASE);
        $this->db = $db_connect->getConnect();
    }

    public function get(int $id)
    {
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE id = ' . $id;
        $res = mysqli_query($this->db, $sql);
        if (mysqli_num_rows($res) > 0) {
            return mysqli_fetch_assoc($res);
        }
        return false;
    }

    public function getAll($sort = '', $limit = '')
    {
        $sql = 'SELECT * FROM ' . $this->table . ' ' . $sort. ' ' . $limit;
        $res = mysqli_query($this->db, $sql);
        if (mysqli_num_rows($res) > 0) {
            return mysqli_fetch_all($res, MYSQLI_ASSOC);
        }
        return false;
    }

    private function row_wrap(array $data)
    {
        $row_fn = function ($el) {
            return '`' . $el . '`';
        };

        return array_map($row_fn, array_keys($data));
    }

    private function val_wrap(array $data)
    {
        $vals_fn = function ($el) {
            return '\'' . mysqli_real_escape_string($this->db, htmlspecialchars($el)) . '\'';
        };

        return array_map($vals_fn, $data);
    }

    public function add(array $data)
    {
        $save_rows = [];
        foreach ($this->rows as $v) {
            if (isset($data[$v])) {
                $save_rows[$v] = $data[$v];
            }
        }

        if (count($save_rows) > 0) {
            $rows = $this->row_wrap($save_rows);
            $vals = $this->val_wrap($save_rows);

            $sql = 'INSERT INTO ' . $this->table . ' (' . implode(', ', $rows). ') VALUES' . '(' . implode(', ', $vals). ')';
            mysqli_query($this->db, $sql);

            return true;
        }

        return false;
    }

    private function set_wrap(array $data)
    {
        $vals_fn = function ($el, $key) {
            return '`' . $key . '` = \'' . mysqli_real_escape_string($this->db, htmlspecialchars($el)) . '\'';
        };

        return array_map($vals_fn, $data, array_keys($data));
    }

    public function update(int $id, array $data)
    {
        $save_rows = [];
        foreach ($this->rows as $v) {
            if (isset($data[$v])) {
                $save_rows[$v] = $data[$v];
            }
        }

        if (count($save_rows) > 0) {
            $rows = $this->set_wrap($save_rows);

            $sql = 'UPDATE ' . $this->table . ' SET ' . implode(', ', $rows). ' WHERE id = ' . $id;
            mysqli_query($this->db, $sql);

            return true;
        }

        return false;
    }

    public function getCount()
    {
        $sql = 'SELECT count(*) as `count_row` FROM ' . $this->table;
        $res = mysqli_query($this->db, $sql);
        if (mysqli_num_rows($res) > 0) {
            return mysqli_fetch_assoc($res)['count_row'];
        }
        return 0;
    }
}