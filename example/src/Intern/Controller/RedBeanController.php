<?php
namespace Intern\Controller;

class RedBeanController
{
    protected $table;
    public $dataModel;

    protected $tag;
    protected $paginate_count;

    //config
    public $timestamp = false;

    function __construct($id = 0, $bypass_prefix = false)
    {
        //if you not override $table, it will use class name as table's name
        if (empty($this->table)) {
            $ex = explode("\\", get_called_class());
            $this->table = strtolower($ex[count($ex)-1]);
        }

        if (!$bypass_prefix) {
            $this->dataModel = \R::dispense($this->table); //underscore is relation
        } else {
            $this->dataModel = \R::getRedBean()->dispense( $this->table ); //can use underscore
        }

        if ($id > 0) {
            $this->readAction($id);
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
    public function getTable()
    {
        return $this->table;
    }

//    public function addTag($tag = [])
//    {
//        return \R::addTags($this->table, $tag);
//    }
//
//    public function hasTag($tag = [])
//    {
//        return \R::hasTag($this->table, $tag);
//    }
//
//    public function removeTag($tag = [])
//    {
//        return \R::untag($this->table, $tag);
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getTag($tag = [])
//    {
//        return \R::tagged($this->table, $tag = []);
//    }

    //-------------ACTION-------------//

    /**
     * @return int|string
     * @throws \Exception
     */
    public function insertAction($force = false)
    {
        if ($this->dataModel->id > 0 && !$force) {
            throw new \Exception("Insert don't need ID, it's auto increase");
        }
        if ($this->timestamp) {
            $this->dataModel->created_at = date("Y-m-d H:i:s");
            $this->dataModel->updated_at = date("Y-m-d H:i:s");
        }
        return \R::store($this->dataModel);
    }

    /**
     * @return int|string
     * @throws \Exception
     */
    public function updateAction($force = false)
    {
        if (!$this->dataModel->id > 0 && !$force) {
            throw new \Exception("Update Need ID (please put id when you new class");
        }

        if ($this->timestamp) {
            $this->dataModel->updated_at = date("Y-m-d H:i:s");
        }

        return \R::store($this->dataModel);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function readAction($id = 0)
    {
        if ($id > 0) {
            $this->dataModel->id = $id;
        }

        $data = \R::load($this->table, $this->dataModel->id);
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
        return array_values(\R::findAll( $this->table , $concat));
    }

    /**
     * @example  readAllAction('ORDER BY title DESC LIMIT 10');
     * @param string $AddQuery
     * @return array
     */
    public function readAllCustomQueryAction($AddQuery = '')
    {
        return array_values(\R::findAll($this->table, $AddQuery));
    }

    public function deleteAction()
    {
        return \R::trash($this->table, $this->dataModel->id);
    }

    /**
     * @param string $AddQuery
     * @return int
     */
    public function countAction($AddQuery = '')
    {
        return \R::count($this->table, $AddQuery);
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

        return \R::find($this->table, $findBy.' LIKE ? '.$concat, [ '%'.$keyword.'%' ] );
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
            $this->paginate_count = \R::count($this->table, $search_key.' LIKE ? ', [ '%'.$search_value.'%' ]);
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
        return \R::findOne($this->table, $findBy.'='.$value);
    }

    //-------- ETC --------//
    public function setTableComment($comment) {
        \R::exec(sprintf("ALTER TABLE %s COMMENT '%s'", $this->table, $comment));
    }

    public function resetAutoIncrement()
    {
        \R::exec(sprintf("ALTER TABLE %s AUTO_INCREMENT = 1", $this->table));
    }

    public function updateRelation($column = 'customer_id', $hookTable = 'customers')
    {
        \R::exec(sprintf(
            "ALTER TABLE %s ADD CONSTRAINT `%s` FOREIGN KEY (`%s`) REFERENCES `%s` (`%s`) ON DELETE CASCADE ON UPDATE CASCADE"
        , $this->table, 'c_fk_'.$this->table.'_'.$column, $column, $hookTable, $column));
    }

    public function setDefaultValue($column_name, $defaultValue)
    {
        \R::exec(sprintf("ALTER TABLE %s ALTER COLUMN %s SET DEFAULT '%s';", $this->table, $column_name, $defaultValue));
    }

    //-------- Private Zone --------//

}
