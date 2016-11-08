<?php
namespace Intern\Controller;

class RedBeanController
{
    protected $tableId;
    protected $tableName;
    public $dataModel;

    protected $tag;
    protected $paginate_count;

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

    public function addTag($tag = [])
    {
        return \R::addTags($this->tableName, $tag);
    }

    public function hasTag($tag = [])
    {
        return \R::hasTag($this->tableName, $tag);
    }

    public function removeTag($tag = [])
    {
        return \R::untag($this->tableName, $tag);
    }

    /**
     * @return mixed
     */
    public function getTag($tag = [])
    {
        return \R::tagged($this->tableName, $tag = []);
    }

    //-------------ACTION-------------//

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

    /**
     * @return bool
     */
    public function readAction()
    {
        $data = \R::load($this->tableName, $this->tableId);
        if ($data->id) {
            $this->dataModel = $data;
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $orderBy
     * @param bool $sortReverse
     * @param string $limit
     * @return array
     */
    public function readAllAction($orderBy = '', $sortReverse = false, $limit = '')
    {
        $concat = '';
        if ($orderBy!='')
            $concat.=' ORDER BY '.$orderBy.' '.($sortReverse?'DESC':'ASC');
        if ($limit!='')
            $concat.=' LIMIT '.$limit;
        return array_values(\R::findAll( $this->tableName , $concat));
    }

    /**
     * @example  readAllAction('ORDER BY title DESC LIMIT 10');
     * @param string $AddQuery
     * @return array
     */
    public function readAllCustomQueryAction($AddQuery = '')
    {
        return array_values(\R::findAll($this->tableName, $AddQuery));
    }

    /**
     * @return bool
     */
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

    /**
     * @param string $findBy
     * @param $keyword
     * @param string $orderBy
     * @param bool $sortReverse
     * @param string $limit
     * @return array
     */
    public function findLikeAction($findBy = 'id', $keyword, $orderBy = 'id', $sortReverse = false, $limit = '')
    {
        $concat =' ORDER BY '.$orderBy.' '.($sortReverse?'DESC':'ASC');
        if ($limit!='')
            $concat.=' LIMIT '.$limit;

        return \R::find($this->tableName, $findBy.' LIKE ? '.$concat, [ '%'.$keyword.'%' ] );
    }

    /**
     * Readme: You can take return; as array for loop OR json_encode
     * @param int $page
     * @param int $limit
     * @param string $orderBy
     * @param bool $sortReverse DESC or ASC
     * @param string $search_key
     * @param string $search_value
     * @return array
     */
    public function paginateAction($page = 1, $limit = 5, $orderBy = 'id', $sortReverse = false, $search_key = '', $search_value = '')
    {
        if ($search_key=='' && $search_value=='') {
            //if you paginate
            $this->paginate_count = $this->countAction();
            return $this->readAllAction($orderBy, $sortReverse, ($page - 1) * $limit . ', ' . $limit);
        }
        else {
            //if you search
            $this->paginate_count = \R::count($this->tableName, $search_key.' LIKE ? ', [ '%'.$search_value.'%' ]);
            return $this->findLikeAction($search_key, $search_value, $orderBy, $sortReverse, ($page - 1) * $limit . ', ' . $limit);
        }
    }

    /**
     * @param int $page
     * @param int $limit
     * @param string $prefix
     * @param string $buttonClass
     * @return string echo ME!!
     */
    public function paginateButtonAction($page = 1, $limit = 5, $prefix = 'page', $buttonClass = 'pagination')
    {
        $total = $this->paginate_count;
        $adjacents = "2";

        $firstLabel = "&lsaquo;&lsaquo; First";
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

            //if page more than 1
            if ($page > 1) {
                $pagination.= "<li><a href='{$url}page=1'>{$firstLabel}</a></li>";
                $pagination.= "<li><a href='{$url}page={$prev}'>{$prevLabel}</a></li>";
            }

            if ($lastPage < 7 + ($adjacents * 2)){

                for ($i = 1; $i <= $lastPage; $i++){
                    echo $i.":".$page;
                    if ($i == $page)
                        $pagination.= "<li><a class='current'>ioi{$i}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}{$prefix}={$i}'>{$i}</a></li>";
                }

            } elseif($lastPage > 5 + ($adjacents * 2)){

                if($page < 1 + ($adjacents * 2)) {
                    //When first
                    for ($i = 1; $i < 4 + ($adjacents * 2); $i++){
                        if ($i == $page)
                            $pagination.= "<li class='active'><a class='current'>{$i}</a></li>";
                        else
                            $pagination.= "<li><a href='{$url}page={$i}'>{$i}</a></li>";
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
                    for ($i = $page - $adjacents; $i <= $page + $adjacents; $i++) {
                        //when middle
                        if ($i == $page)
                            $pagination .= "<li class='active'><a class='current'>{$i}</a></li>";
                        else
                            $pagination .= "<li><a href='{$url}page={$i}'>{$i}</a></li>";
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
                    for ($i = $lastPage - (2 + ($adjacents * 2)); $i <= $lastPage; $i++) {
                        if ($i == $page)
                            $pagination.= "<li class='active'><a class='current'>{$i}</a></li>";
                        else
                            $pagination.= "<li><a href='{$url}page={$i}'>{$i}</a></li>";
                    }
                }
            }

            if ($page < $i - 1) {
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

}
