<?php
/**
 * Mr.Infinite Beta
 * use for Redbean 4.^ for core
 * By arnanthachai@intbizth.com
 */
namespace vendor\wp_infinite\Controller;

use RedBeanPHP\Facade;
use RedBeanPHP\OODB;

class PaginateController //extends Facade
{
    public $model;
    protected $table;

    protected $item_count;
    protected $current_page = 1;
    protected $item_per_page = 5;
    protected $search = '';

    protected $button_range = 5;

    /**
     * PaginateController constructor.
     * @param $model ModelController
     * Example: $shop = new Shop();
     *          $paginate = new PaginateController($shop);
     */
    function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getItemCount()
    {
        return $this->item_count;
    }

    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->current_page;
    }

    /**
     * @param int $current_page
     */
    public function setCurrentPage(int $current_page = 0)
    {
        $this->current_page = $current_page;
    }

    /**
     * @return int
     */
    public function getItemPerPage(): int
    {
        return $this->item_per_page;
    }

    /**
     * @param int $item_per_page
     */
    public function setItemPerPage(int $item_per_page = 5)
    {
        $this->item_per_page = $item_per_page;
    }

    /**
     * @return string
     */
    public function getSearch(): string
    {
        return $this->search;
    }

    /**
     * @param string $search
     */
    public function setSearch(string $search)
    {
        $this->search = $search;
    }

    /**
     * Readme: You can take return; as array for loop OR json_encode
     * @param int $page
     * @param int $limit
     * @param string $orderBy
     * @param bool $sortReverse DESC or ASC
     * @param string $search_column
     * @param string $search_value
     * @return array|object
     */
    public function paginateAction($orderBy = 'id', $sortReverse = false, $search_column = '', $search_value = '', $searchLike = true)
    {
        if ($this->getCurrentPage() < 1 )
            $this->setCurrentPage(1);

        if ($search_column=='' && $search_value=='') {
            //if you paginate
            $this->item_count = $this->model->countAction();

            return $this->model->findAllAction($orderBy, $sortReverse, ($this->getCurrentPage() - 1) * $this->getItemPerPage() . ', ' . $this->getItemPerPage());
        }
        else {
            //if you search
            if ($searchLike) {
                $this->item_count = \R::count($this->model->getTable(), $search_column.' LIKE ? ', [ '%'.$search_value.'%' ]);
                return $this->model->findLikeAction($search_column, $search_value, $orderBy, $sortReverse, ($this->getCurrentPage() - 1) * $this->getItemPerPage() . ', ' . $this->getItemPerPage());
            }
            else {
                $this->item_count = \R::count($this->model->getTable(), $search_column.' = ? ', [ $search_value ]);
                return $this->model->findAction($search_column, $search_value, $orderBy, $sortReverse, ($this->getCurrentPage() - 1) * $this->getItemPerPage() . ', ' . $this->getItemPerPage());
            }

        }
    }

    /**
     * @param int $page
     * @param int $limit
     * @param string $prefix
     * @param string $buttonClass
     * @return string echo ME!!
     */
    public function paginateButtonAction($prefix = '?page=', $buttonClass = 'pagination')
    {
        $total = $this->item_count;
        $adjacents = "2";

        $firstLabel = "&lsaquo;&lsaquo; First";
        $prevLabel = "&lsaquo; Prev";
        $nextLabel = "Next &rsaquo;";
        $lastLabel = "Last &rsaquo;&rsaquo;";

        $page = ($this->getCurrentPage() == 0 ? 1 : $this->getCurrentPage());
        $start = ($page - 1) * $this->getItemPerPage();

        $prev = $page - 1;
        $next = $page + 1;

        $lastPage = ceil($total/$this->getItemPerPage());

        $lpm1 = $lastPage - 1; // //last page minus 1

        $pagination = "";

        $url = $prefix;

        if($lastPage > 1){
            $pagination .= "<ul class='pagination'>";
            //$pagination .= "<li class='page_info'>Page {$page} of {$lastPage}</li>";

            //if page more than 1
            if ($page > 1) {
                $pagination.= "<li><a href='{$url}1'>{$firstLabel}</a></li>";
                $pagination.= "<li><a href='{$url}{$prev}'>{$prevLabel}</a></li>";
            }

            if ($lastPage < 7 + ($adjacents * 2)){

                for ($i = 1; $i <= $lastPage; $i++){
                    echo $i.":".$page;
                    if ($i == $page)
                        $pagination.= "<li><a class='current'>{$i}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}{$i}'>{$i}</a></li>";
                }

            } elseif($lastPage > 5 + ($adjacents * 2)){

                if($page < 1 + ($adjacents * 2)) {
                    //When first
                    for ($i = 1; $i < 4 + ($adjacents * 2); $i++){
                        if ($i == $page)
                            $pagination.= "<li class='active'><a class='current'>{$i}</a></li>";
                        else
                            $pagination.= "<li><a href='{$url}{$i}'>{$i}</a></li>";
                    }
                    $pagination.= "<li class='dot'><a>...</a></li>";
                    $pagination.= "<li><a href='{$url}{$lpm1}'>{$lpm1}</a></li>";
                    $pagination.= "<li><a href='{$url}{$lastPage}'>{$lastPage}</a></li>";

                } elseif($lastPage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    //when middle end
                    $pagination.= "<li><a href='{$url}1'>1</a></li>";
                    $pagination.= "<li><a href='{$url}2'>2</a></li>";
                    //when middle first
                    $pagination.= "<li class='dot'><a>...l</a></li>";
                    for ($i = $page - $adjacents; $i <= $page + $adjacents; $i++) {
                        //when middle
                        if ($i == $page)
                            $pagination .= "<li class='active'><a class='current'>{$i}</a></li>";
                        else
                            $pagination .= "<li><a href='{$url}{$i}'>{$i}</a></li>";
                    }
                    $pagination.= "<li class='dot'><a> ..p</a></li>";
                    $pagination.= "<li><a href='{$url}{$lpm1}'>{$lpm1}</a></li>";
                    $pagination.= "<li><a href='{$url}{$lastPage}'>{$lastPage}</a></li>";

                } else {
                    //When end
                    $pagination.= "<li><a href='{$url}1'>1</a></li>";
                    $pagination.= "<li><a href='{$url}2'>2</a></li>";
                    //split front
                    $pagination.= "<li class='dot'><a>..</a></li>";
                    for ($i = $lastPage - (2 + ($adjacents * 2)); $i <= $lastPage; $i++) {
                        if ($i == $page)
                            $pagination.= "<li class='active'><a class='current'>{$i}</a></li>";
                        else
                            $pagination.= "<li><a href='{$url}{$i}'>{$i}</a></li>";
                    }
                }
            }

            if ($page < $i - 1) {
                $pagination.= "<li><a href='{$url}{$next}'>{$nextLabel}</a></li>";
                $pagination.= "<li><a href='{$url}{$lastPage}'>{$lastLabel}</a></li>";
            }

            $pagination.= "</ul>";
        }

        return $pagination;
        //return $concat;
    }

    public function paginateButtonArray()
    {
        $pages = [];
        $totalPages = ceil($this->button_range / $this->getItemPerPage());
        $halfWay = ceil($this->button_range / 2);
        $position = '';

        if ($this->getCurrentPage() <= $halfWay) {
            $position = 'start';
        } else if ($totalPages - $halfWay < $this->getCurrentPage()) {
            $position = 'end';
        } else {
            $position = 'middle';
        }

        $ellipsesNeeded = $this->button_range < $totalPages;
        $i = 1;
        while ($i <= $totalPages && $i <= $this->button_range) {
            $pageNumber = $this->calculatePageNumber($i, $this->current_page, $this->button_range, $totalPages);

            $openingEllipsesNeeded = ($i === 2 && ($position === 'middle' || $position === 'end'));
            $closingEllipsesNeeded = ($i === $this->button_range - 1 && ($position === 'middle' || $position === 'start'));
            if ($ellipsesNeeded && ($openingEllipsesNeeded || $closingEllipsesNeeded)) {
                array_push($pages, '...');
            } else {
                array_push($pages, $pageNumber);
            }
            $i ++;
        }
        return $pages;
    }
    private function calculatePageNumber($i, $currentPage, $paginationRange, $totalPages) {
        $halfWay = ceil($paginationRange / 2);
        if ($i === $paginationRange) {
            return $totalPages;
        } else if ($i === 1) {
            return $i;
        } else if ($paginationRange < $totalPages) {
            if ($totalPages - $halfWay < $currentPage) {
                return $totalPages - $paginationRange + $i;
            } else if ($halfWay < $currentPage) {
                return $currentPage - $halfWay + $i;
            } else {
                return $i;
            }
        } else {
            return $i;
        }
    }
}
