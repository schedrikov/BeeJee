<?php

namespace app;

class SortFilters
{
    private $data_sort;

    public function __construct($data_sort)
    {
        $this->data_sort = $data_sort;
    }

    public function show()
    {
        if (count($this->data_sort) == 0) return '';

        $selected_id = (int)($_COOKIE['sort']) ? : 0;

        $s = '<select class="filters-sort">';
        foreach ($this->data_sort as $k => $v) {
            if ($selected_id == $k) {
                $s .= '<option value="' . $k . '" selected>' . $v['name'] . '</option>';
            } else {
                $s .= '<option value="' . $k . '">' . $v['name'] . '</option>';
            }
        }
        $s .= '</select>';

        return $s;
    }

    public function getSort()
    {
        $selected_id = (int)($_COOKIE['sort']) ? : 0;
        if (isset($this->data_sort[$selected_id]['sort'])) {
            return $this->data_sort[$selected_id]['sort'];
        }

        return '';
    }
}