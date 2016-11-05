<?php
namespace RB\Controller;

class RedBeanController
{
    protected $tableId;
    protected $tableName;
    public $dataModel;

    function __construct($tableId = 0)
    {
        if ($tableId > 0) {
            $this->tableId = $tableId;
        }
        else {
            $this->dataModel = \R::dispense($this->tableName);
        }
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->dataModel->id;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @param string $tableName
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    public function insertAction()
    {
        if ($this->tableId > 0) {
            throw new \Exception("Insert don't need ID, it's auto increase");
        }
        return \R::store($this->dataModel);
    }

    public function updateAction()
    {
        if (!$this->tableId > 0) {
            throw new \Exception("Update Need ID (please put id when you new class");
        }
        return \R::store($this->dataModel);
    }

    public function readAction()
    {
        $this->dataModel = \R::load($this->tableName, $this->tableId);
    }

    /**
     * @example  readAllAction('ORDER BY title DESC LIMIT 10');
     * @param string $AddQuery
     * @return array
     */
    public function readAllAction($AddQuery = '')
    {
        return \R::findAll($this->tableName, $AddQuery);
    }

    public function deleteAction()
    {
        return \R::trash($this->tableName, $this->tableId);
    }

    /**
     * @param string $AddQuery
     * @return int
     */
    public function countAction($AddQuery = '')
    {
        return \R::count($this->tableName, $AddQuery);
    }

    public function paginateAction($page = 1, $limit = 5, $orderBy = 'id', $sortReverse = false)
    {
        return $this->findAll($orderBy, $sortReverse, ($page-1)*$limit.', '.$limit);
        return $this->readAllAction('ORDER BY '.$orderBy.' '.($sortReverse?'DESC':'ASC').' LIMIT '.(($page-1)*$limit).', '.$limit);

    }

    public function paginateButtonAction($page = 1, $limit = 5, $prefix = 'page', $buttonClass = 'pagination')
    {
        $total = $this->countAction();
        $adjacents = "2";

        $prevLabel = "&lsaquo; Prev";
        $nextLabel = "Next &rsaquo;";
        $lastLabel = "Last &rsaquo;&rsaquo;";

        $page = ($page == 0 ? 1 : $page);
        $start = ($page - 1) * $limit;

        $prev = $page - 1;
        $next = $page + 1;

        $lastPage = ceil($total/$limit);

        $lpm1 = $lastPage - 1; // //last page minus 1

        $pagination = "";
        $url = '?';
        if($lastPage > 1){
            $pagination .= "<ul class='pagination'>";
            //$pagination .= "<li class='page_info'>Page {$page} of {$lastPage}</li>";

            if ($page > 1) $pagination.= "<li><a href='{$url}page={$prev}'>{$prevLabel}</a></li>";

            if ($lastPage < 7 + ($adjacents * 2)){

                for ($counter = 1; $counter <= $lastPage; $counter++){
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>ioi{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
                }

            } elseif($lastPage > 5 + ($adjacents * 2)){

                if($page < 1 + ($adjacents * 2)) {
                    //When first
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
                        if ($counter == $page)
                            //When first
                            $pagination.= "<li class='active'><a class='current'>{$counter}</a></li>";
                        else
                            $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
                    }
                    $pagination.= "<li class='dot'><a>...</a></li>";
                    $pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
                    $pagination.= "<li><a href='{$url}page={$lastPage}'>{$lastPage}</a></li>";

                } elseif($lastPage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    //when middle end
                    $pagination.= "<li><a href='{$url}page=1'>1</a></li>";
                    $pagination.= "<li><a href='{$url}page=2'>2</a></li>";
                    //when middle first
                    $pagination.= "<li class='dot'><a>...l</a></li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        //when middle
                        if ($counter == $page)
                            $pagination .= "<li class='active'><a class='current'>{$counter}</a></li>";
                        else
                            $pagination .= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
                    }
                    $pagination.= "<li class='dot'><a> ..p</a></li>";
                    $pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
                    $pagination.= "<li><a href='{$url}page={$lastPage}'>{$lastPage}</a></li>";

                } else {
                    //When end
                    $pagination.= "<li><a href='{$url}page=1'>1</a></li>";
                    $pagination.= "<li><a href='{$url}page=2'>2</a></li>";
                    //split front
                    $pagination.= "<li class='dot'><a>..</a></li>";
                    for ($counter = $lastPage - (2 + ($adjacents * 2)); $counter <= $lastPage; $counter++) {
                        if ($counter == $page)
                            $pagination.= "<li class='active'><a class='current'>{$counter}</a></li>";
                        else
                            $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
                    }
                }
            }

            if ($page < $counter - 1) {
                $pagination.= "<li><a href='{$url}page={$next}'>{$nextLabel}</a></li>";
                $pagination.= "<li><a href='{$url}page=$lastPage'>{$lastLabel}</a></li>";
            }

            $pagination.= "</ul>";
        }

        return $pagination;
        //return $concat;
    }

    //--------- FINDING Zone --------//
    //TODO: Test it
    public function findOneByAction($findBy = 'id', $value = '1')
    {
        return \R::findOne($this->tableName, $findBy.'='.$value);
    }

    //TODO: Test it
    public function findAll($orderBy = '', $sortReverse = false, $limit = '')
    {
        $concat = '';
        if ($orderBy!='')
            $concat.=' ORDER BY '.$orderBy.' '.($sortReverse?'DESC':'ASC');
        if ($limit!='')
            $concat.=' LIMIT '.$limit;
        return \R::findAll( $this->tableName , $concat);
    }
}
