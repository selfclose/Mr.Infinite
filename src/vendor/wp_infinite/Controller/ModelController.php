<?php
/**
 * Mr.Infinite Beta
 * use for Redbean 4.^ for core
 * By arnanthachai@intbizth.com
 */
namespace vendor\wp_infinite\Controller;

use RedBeanPHP\Facade;
use RedBeanPHP\OODB;

class ModelController extends UtilitiesController
{
    protected $id;
    protected $table;
    public $dataModel;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTable()
    {
        //if not override $table, it will use class name who's calling as table name
        if (is_null($this->table)) {
            $this->table = strtolower(get_class_vars(get_called_class())['table']);

            if (empty($this->table)) {
                $ex = explode("\\", get_called_class());
                return $this->table = strtolower(end($ex));
            }
        }
        return $this->table;
    }

    //-------------CRUD-------------//

    /**
     * @return int|string
     * @throws \Exception
     */
    public function insertAction($force = false)
    {
        //Dispense if force use getRedBean
        $bean = \R::getRedBean()->dispense($this->getTable()); //can use underscore

        //collect property
        $props = array_diff_key(get_object_vars($this), array_flip(['table', 'id', 'dataModel']));

        foreach ($props as $key=>$val) {
            if (is_null($val))
                unset($props[$key]);
        }

        //TODO: Go to timestamp trait
//        if ($this->timestamp) {
//            $this->created_at = $this->getCurrentTime();
//            $this->updated_at = $this->getCurrentTime();
//        }
        return \R::store($bean->import($props));
    }

    /**
     * @return int|string
     * @throws \Exception
     */
    public function updateAction($force = false)
    {
        if (is_null($this->id) && !$force) {
            throw new \Exception("**[ wp_infinite Error : \"Update Need ID (Have you use '->readAction()' yet?)\" ]**");
        }

        $this->__onUpdateAction();

        //collect property
        $props = array_diff_key(get_object_vars($this), array_flip(['table', 'dataModel']));

        foreach ($props as $key=>$val) {
            if (is_null($val))
                unset($props[$key]);
        }
        $bean = \R::getRedBean()->dispense($this->getTable()); //can use underscore

        return \R::store($bean->import($props));
    }

    public function __onUpdateAction() {
        //FOR OVERRIDE ONLY
    }

    protected function _collect_action($class_ins, $removes = []) {
        //collect property
        $props = array_diff_key(get_object_vars($this), array_flip(['table', 'dataModel']));

        foreach ($props as $key=>$val) {
            if (is_null($val))// or !is_numeric($val) or !is_string($val) or !is_array($val) or !is_bool($val) or !$val instanceof \DateTime)
                unset($props[$key]);
        }
        return $props;
    }

    /**
     * @param int $id
     * @return bool | array
     */
    public function readAction($id = 1)
    {
        if (is_array($id)) {
            return \R::loadAll($this->getTable(), array_column($id, 'id'));
        }

        $data = \R::load($this->getTable(), $id)->export();

        if (count($data)) {
            foreach($data as $key => $value){
                $this->{$key} = $value;
            }

            return $data;
        } else {
            return false;
        }
    }

    /**
     * @param $getClassMethod object|OODB such as ->getEducations()
     * @param array $ids
     * @return array
     */
    public function readAllAction($ids = [1, 2, 3])
    {
        return array_values(\R::loadAll($this->getTable(), $ids));
    }

    public function deleteAction($id)
    {
        if (!is_null($this->id))
            \R::trash($this->getTable(), $this->id);
        else
            return \R::trash($this->getTable(), $id);
    }

    public function queryGet()
    {
        $arr = [];
        $var = get_object_vars($this);
        foreach ($var as $key => $val) {
            if (!is_null($val)) {
                $this->$key = $val;
            }
        }
        var_dump($this);
    }

    /**
     * @param string $orderBy
     * @param bool $sortReverse
     * @param string $limit
     * @return object
     */
    public function findAllAction($orderBy = '', $sortReverse = false, $limit = '')
    {
        global $wpdb;
        $concat = '';
        if ($orderBy != '')
            $concat .= ' ORDER BY ' . $orderBy . ' ' . ($sortReverse ? 'DESC' : 'ASC');
        if ($limit != '')
            $concat .= ' LIMIT ' . $limit;
        return $wpdb->get_results("SELECT * FROM {$this->getTable()}{$concat}");
    }

    public function Query($query_command)
    {
        global $wpdb;
        return $wpdb->get_results($query_command);
    }

    /**
     * @param string $column
     * @param $find
     * @param bool $sortReverse
     * @return int
     * Find Row Index for example : Top Money, what is my position?
     */
    public function findRowIndex($column = 'id', $find, $sortReverse = false)
    {
        global $wpdb;
        return $wpdb->get_row("SELECT (SELECT COUNT(*) FROM {$this->getTable()} WHERE {$column} " . ($sortReverse ? "<=" : ">=") . " '{$find}') AS position FROM {$this->getTable()} WHERE {$column} = '{$find}'")->position;
    }

    /**
     * @example  findAllAction('ORDER BY title DESC LIMIT 10');
     * @param string $AddQuery
     * @return array
     */
    public function readAllCustomQueryAction($AddQuery = '')
    {
        return array_values(\R::findAll($this->getTable(), $AddQuery));
    }

    //--------- FINDING Zone --------//
    /**
     * @param string $findBy
     * @param string $keyword
     * @return int
     */
    public function countAction($findBy = 'id', $keyword = '')
    {
        if ($keyword == '')
            return \R::count($this->getTable());
        else
            return \R::count($this->getTable(), " {$findBy} = ?", [$keyword]);
    }

    /**
     * @param string $findBy
     * @param $keyword
     * @param string $orderBy
     * @param bool $sortReverse
     * @param string $limit
     * @return array
     */
    public function findAction($findBy = 'id', $keyword, $orderBy = 'id', $sortReverse = false, $limit = '')
    {
        global $wpdb;
        $concat = ' ORDER BY ' . $orderBy . ' ' . ($sortReverse ? 'DESC' : 'ASC');
        if ($limit != '')
            $concat .= ' LIMIT ' . $limit;

        return $wpdb->get_results("SELECT * FROM {$this->getTable()} WHERE {$findBy} = '{$keyword}'{$concat}");
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
        global $wpdb;
        $concat = ' ORDER BY ' . $orderBy . ' ' . ($sortReverse ? 'DESC' : 'ASC');
        if ($limit != '')
            $concat .= ' LIMIT ' . $limit;

        return $wpdb->get_results("SELECT * FROM {$this->getTable()} WHERE {$findBy} LIKE '%{$keyword}%'{$concat}");
    }

    public function readByAction($findBy = 'id', $value = '1')
    {
        $bean = \R::findOne($this->getTable(), $findBy . ' = ? ', [$value]);

        //If ID is upper case fix (redbean upper bug)
        if (is_array($bean) || is_object($bean)) {

            foreach($bean as $key => $value){
                $this->{$key} = $value;
            }

            foreach ($bean as $key => $val) {
                if ($key == 'ID') {
                    $this->id = $val;
                }
            }
        }
    }

    public function findOneBy($column = 'id', $find)
    {
        global $wpdb;
        return $wpdb->get_row("SELECT * FROM {$this->getTable()} WHERE {$column} = '{$find}'");
    }

    //-------- ETC --------//
    public function setTableComment($comment)
    {
        \R::exec("ALTER TABLE `{$this->getTable()}` COMMENT '{$comment}'");
    }

    /**
     * @param $column_name
     * @param $comment
     * @return bool|int
     */
    public function setColumnComment($column_name, $comment)
    {
        global $wpdb;
        $type = $wpdb->get_row("SHOW FIELDS FROM {$this->getTable()} WHERE FIELD ='{$column_name}'")->Type;
        return $wpdb->query("ALTER TABLE `{$this->getTable()}` CHANGE `{$column_name}` `{$column_name}` {$type} COMMENT '{$comment}'");
    }

    public function resetAutoIncrement()
    {
        \R::exec("ALTER TABLE {$this->getTable()} AUTO_INCREMENT = 1");
    }

    public function updateRelation($column = 'customer_id', $hookTable = 'customers')
    {
        \R::exec(sprintf(
            "ALTER TABLE %s ADD CONSTRAINT `%s` FOREIGN KEY (`%s`) REFERENCES `%s` (`%s`) ON DELETE CASCADE ON UPDATE CASCADE"
            , $this->getTable(), 'c_fk_' . $this->getTable() . '_' . $column, $column, $hookTable, $column));
    }

    public function setDefaultValue($column_name, $defaultValue)
    {
        \R::exec(sprintf("ALTER TABLE %s ALTER COLUMN %s SET DEFAULT '%s';", $this->getTable(), $column_name, $defaultValue));
    }

    public function setUnique($columns = [])
    {
        //TODO: change to wpdb;
        $this->setMeta("buildcommand.unique", $columns);
    }

    //--------------- RELATION HELPER ----------------//
    static function OwnOneBy($by_column_name = 'id', $expression = '=', $value)
    {
        if (is_null($value) or empty($value))
            throw new \Exception("**[ wp_infinite Error : \"Can't find item, Need ID (Have you use '->readAction(*id*)' yet?)\" ]**");
        return \R::findOne(self::getTableClass(), "{$by_column_name} {$expression} ?", [$value] );

    }

    static function ownById($id)
    {
        if (is_null($id) or empty($id))
            throw new \Exception("**[ wp_infinite Error : \"Can't find item, Need ID (Have you use '->readAction(*id*)' yet?)\" ]**");
        return \R::load(self::getTableClass(), $id );

    }

    static function getTableClass() {
        $table = strtolower(get_class_vars(get_called_class())['table']);
        if (empty($table))
            return strtolower(end(explode("\\", get_called_class())));
        return$table;
    }
    //-------- Private Zone --------//
}