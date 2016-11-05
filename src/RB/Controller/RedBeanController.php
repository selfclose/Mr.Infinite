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

    public function paginateAction($page = 1, $limit = 5, $orderBy = 'id')
    {
        return $this->readAllAction('ORDER BY '.$orderBy.' LIMIT '.(($page-1)*$limit).', '.$limit);

    }

    public function paginateButtonAction($page = 1, $limit = 5, $buttonClass = 'pagination', $prefix = 'page')
    {
//        $concat = '<ul class="pagination">';
//        $concat.= sprintf('<li><a href="?%s=%s" disabled="true" data-original-title="" title="">&laquo;</a></li>', $prefix, $page-1);
//
//        for ($i=0;$i<$this->countAction() / $limit;$i++) {
//            $concat.= sprintf('<li><a href="?%s=%s" data-original-title="" title="">$i</a></li>', $prefix, $i, $i);
//        }
//
//        $concat.= sprintf('<li><a href="?p=0" disabled="true" data-original-title="" title="">&raquo;</a></li>', 0);
//
//        $concat.='</ul>';
//        $concat.= '<a class="'.$buttonClass.'">&laquo;</a>';
//        $concat.= sprintf('<a href="?%s=%s">%s</a>'
//            , $prefix, htmlspecialchars($page, ENT_QUOTES, 'UTF-8')
//            , htmlspecialchars($page, ENT_QUOTES, 'UTF-8'));
//        if ($page > 1) {
//
//        }


        //----------------------
        $total = $this->countAction();
        $adjacents = "2";

        $prevlabel = "&lsaquo; Prev";
        $nextlabel = "Next &rsaquo;";
        $lastlabel = "Last &rsaquo;&rsaquo;";

        $page = ($page == 0 ? 1 : $page);
        $start = ($page - 1) * $limit;

        $prev = $page - 1;
        $next = $page + 1;

        $lastpage = ceil($total/$limit);

        $lpm1 = $lastpage - 1; // //last page minus 1

        $pagination = "";
        $url = '?';
        if($lastpage > 1){
            $pagination .= "<ul class='pagination'>";
            $pagination .= "<li class='page_info'>Page {$page} of {$lastpage}</li>";

            if ($page > 1) $pagination.= "<li><a href='{$url}page={$prev}'>{$prevlabel}</a></li>";

            if ($lastpage < 7 + ($adjacents * 2)){
                for ($counter = 1; $counter <= $lastpage; $counter++){
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
                }

            } elseif($lastpage > 5 + ($adjacents * 2)){

                if($page < 1 + ($adjacents * 2)) {

                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
                        if ($counter == $page)
                            $pagination.= "<li><a class='current'>{$counter}</a></li>";
                        else
                            $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
                    }
                    $pagination.= "<li class='dot'>...</li>";
                    $pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
                    $pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";

                } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {

                    $pagination.= "<li><a href='{$url}page=1'>1</a></li>";
                    $pagination.= "<li><a href='{$url}page=2'>2</a></li>";
                    $pagination.= "<li class='dot'>...</li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $pagination.= "<li><a class='current'>{$counter}</a></li>";
                        else
                            $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
                    }
                    $pagination.= "<li class='dot'>..</li>";
                    $pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
                    $pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";

                } else {

                    $pagination.= "<li><a href='{$url}page=1'>1</a></li>";
                    $pagination.= "<li><a href='{$url}page=2'>2</a></li>";
                    $pagination.= "<li class='dot'>..</li>";
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                        if ($counter == $page)
                            $pagination.= "<li class='active'><a class='current'>{$counter}</a></li>";
                        else
                            $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
                    }
                }
            }

            if ($page < $counter - 1) {
                $pagination.= "<li><a href='{$url}page={$next}'>{$nextlabel}</a></li>";
                $pagination.= "<li><a href='{$url}page=$lastpage'>{$lastlabel}</a></li>";
            }

            $pagination.= "</ul>";
        }

        return $pagination;
        return $concat;
    }
}
