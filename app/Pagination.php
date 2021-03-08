<?php

namespace app;

class Pagination
{
    private $total;
    private $count_item_page;
    private $current_page;
    private $pages;

    public function __construct(int $total, int $count_item_page, $current_page)
    {
        $this->total = $total;
        $this->count_item_page = $count_item_page;
        $this->current_page = $current_page;
        if ($this->total == 0) {
            $this->pages = 0;
        } else {
            $this->pages = ceil($this->total / $this->count_item_page);
        }
    }

    public function show()
    {
        if ($this->total == 0 || $this->pages <= 1) return '';

        $s = '<nav aria-label="Page navigation">';
        $s .= '<ul class="pagination">';

        for ($i = 1; $i <= $this->pages; $i++) {
            if ($i == $this->current_page) {
                $s .= '<li class="page-item active"><a class="page-link" href="">' . $i . '</a></li>';
            } else {
                $s .= '<li class="page-item"><a class="page-link" href="/?page=' . $i . '">' . $i . '</a></li>';
            }
        }

        $s .= '</ul>';
        $s .= '</nav>';

        return $s;
    }

    public function getLimit()
    {
        if ($this->pages > 1) {
            $start = ($this->current_page - 1) * $this->count_item_page;
            return ' LIMIT ' . $start . ', ' . $this->count_item_page;
        } else {
            return '';
        }
    }
}