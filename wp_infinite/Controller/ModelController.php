<?php
/**
 * wp_infinite (Beta)
 * use for Redbean >= 4 for core
 * mvc controller By it_531413016@hotmail.com
 */
namespace wp_infinite\Controller;

use RedBeanPHP\Facade;
use RedBeanPHP\OODB;

class ModelController extends UtilitiesController
{
    protected $id;
    protected $table;
    protected $timestamp = true;
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
            $class = get_called_class();
            $this->table = strtolower(get_class_vars($class)['table']);

            if (empty($this->table)) {
                return $this->table = strtolower(substr($class, strripos($class, '\\') + 1));
            }
        }
        return $this->table;
    }

    public static function getTableStatic() {
        $class = get_called_class();
        $table = strtolower(get_class_vars($class)['table']);
        if (empty($table)) {
            return strtolower(substr($class, strripos($class, '\\') + 1));
        }
        return$table;
    }

    //-------------CRUD-------------//

    /**
     * @return int|string
     * @throws \Exception
     */
    public function insertAction($force = false)
    {
        $this->__beforeInsertAction();
        if ($this->timestamp) {
            $this->created_at = $this->getCurrentTime();
            $this->updated_at = $this->getCurrentTime();
        }

        //Dispense if force use getRedBean
        $bean = \R::getRedBean()->dispense($this->getTable()); //can use underscore

        //collect property
        $props = array_diff_key(get_object_vars($this), array_flip(['table', 'id', 'dataModel', 'timestamp']));

        foreach ($props as $key=>$val) {
            if (is_null($val))
                unset($props[$key]);
        }

        if ($res =\R::store($bean->import($props))) {
            $this->__afterInsertAction();
            return $res;
        }
        return false;
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

        $this->__beforeUpdateAction();
        if ($this->timestamp) {
            $this->updated_at = $this->getCurrentTime();
        }

        //collect property
        $props = array_diff_key(get_object_vars($this), array_flip(['table', 'dataModel']));

        foreach ($props as $key=>$val) {
            if (is_null($val))
                unset($props[$key]);
        }
        $bean = \R::getRedBean()->dispense($this->getTable()); //can use underscore

        if ($res = \R::store($bean->import($props))) {
            $this->__afterUpdateAction();
        }
        return $res;
    }

    public function __beforeUpdateAction() {
        //FOR OVERRIDE ONLY
    }
    public function __afterUpdateAction() {
        //FOR OVERRIDE ONLY
    }

    public function __beforeInsertAction() {
        //FOR OVERRIDE ONLY
    }

    public function __afterInsertAction() {
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
     * @param string $findBy
     * @param $value string
     */
    public function readByAction($findBy = 'id', $value)
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

    public static function wipe()
    {
        return \R::wipe(self::getTableStatic());
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

    public function query($query)
    {
        return \R::exec($query);
    }

    //--------- Filter Zone --------//

    static function find($id)
    {
        return \R::load(self::getTableStatic(),$id);
    }

    /**
     * @param string $findBy
     * @param $keyword
     * @param string $orderBy
     * @param bool $sortReverse
     * @param string $limit
     * @return array
     */
    static function findBy($findBy = 'id', $keyword, $orderBy = 'id', $sortReverse = false, $limit = '')
    {
        $concat = ' ORDER BY ' . $orderBy . ' ' . ($sortReverse ? 'DESC' : 'ASC');
        if ($limit != '')
            $concat .= ' LIMIT ' . $limit;

        return \R::find(self::getTableStatic()," WHERE {$findBy} = '{$keyword}'{$concat}");
    }

    /**
     * @example  findWithQuery('ORDER BY title DESC LIMIT 10');
     * @param string $query
     * @return array
     */
    static function findWithQuery($query = '')
    {
        return array_values(\R::findAll(self::getTableStatic(), $query));
    }

    /**
     * @param string $orderBy
     * @param bool $sortReverse
     * @param string $limit
     * @return array
     */
    static function findAll($orderBy = '', $sortReverse = false, $limit = '')
    {
        $concat = '';
        if ($orderBy != '')
            $concat .= ' ORDER BY ' . $orderBy . ' ' . ($sortReverse ? 'DESC' : 'ASC');
        if ($limit != '')
            $concat .= ' LIMIT ' . $limit;
        return \R::findAll(self::getTableStatic(), "SELECT * FROM ".self::getTableStatic()."{$concat}");
    }

    /**
     * @return int
     */
    static function count()
    {
        return \R::count(self::getTableStatic());
    }

    /**
     * @param string $column
     * @param $find string | int
     * @return int
     */
    static function countBy($column = 'id', $operator = '=', $find)
    {
        if (is_null($find))
            die("**wp_infinite** : Need string to find ::countBy('money', '>', '1000');");
        else
            return \R::count(self::getTableStatic(), " {$column} {$operator} ?", [$find]);
    }

    static function countLike($column = 'id', $keyword = '')
    {
        if (substr($keyword, 0, 1) != '%' and substr($keyword, strlen($keyword)-1, 1) != "%")
            $keyword = "%{$keyword}%";

        if (empty($keyword))
            return \R::count(self::getTableStatic());
        else
            return \R::count(self::getTableStatic(), " {$column} like ?", [$keyword]);
    }

    /**
     * @param string $findBy
     * @param array $keyword
     * @param string $orderBy
     * @param bool $sortReverse
     * @param string $limit
     * @return array
     */
    static function findLike($findBy = 'id', $keywords = [], $orderBy = 'id', $sortReverse = false, $limit = '')
    {
        $concat = ' ORDER BY ' . $orderBy . ' ' . ($sortReverse ? 'DESC' : 'ASC');
        if ($limit != '')
            $concat .= ' LIMIT ' . $limit;

        return \R::findLike(self::getTableStatic(), $keywords, $concat);
    }

    static function findOneBy($column = 'id', $find, $expression = '=')
    {
        //global $wpdb;
        //return $wpdb->get_row("SELECT * FROM ".self::getTableStatic()." WHERE {$column} = '{$find}'");
        return \R::findOne(self::getTableStatic(), " {$column} {$expression} ? ", [$find]);
    }

    static function findOneOrCreate($column, $find, $fieldsToCreate, $expression = '=') {
        return \R::findOneOrDispense(self::getTableStatic(), " {$column} {$expression} ? ", [$find]);
    }

    /**
     * @param string $column
     * @param $find
     * @param bool $sortReverse
     * @return int
     * Find Row Index for example : Top Money, what is my position?
     */
    static function findRowIndex($column = 'id', $find, $sortReverse = false)
    {
        return \R::exec("SELECT (SELECT COUNT(*) FROM ".self::getTableStatic()." WHERE {$column} " . ($sortReverse ? "<=" : ">=") . " '{$find}') AS position FROM ".self::getTableStatic()." WHERE {$column} = '{$find}'");
    }

    //-------- ETC --------//
    static function setTableComment($comment)
    {
        \R::exec("ALTER TABLE `".self::getTableStatic()."` COMMENT '{$comment}'");
    }

    /**
     * @param $column_name
     * @param $comment
     */
    static function setColumnComment($column_name, $comment)
    {
        $type = \R::getRow("SHOW FIELDS FROM ".self::getTableStatic()." WHERE FIELD ='{$column_name}'")['Type'];
        \R::exec("ALTER TABLE `".self::getTableStatic()."` CHANGE `{$column_name}` `{$column_name}` {$type} COMMENT '{$comment}'");
    }

    static function resetAutoIncrement()
    {
        return \R::exec("ALTER TABLE ".self::getTableStatic()." AUTO_INCREMENT = 1");
    }

    static function updateRelation($column = 'customer_id', $hookTable = 'customers', $onUpdate = 'CASCADE', $onDelete = 'CASCADE')
    {
        \R::exec(sprintf(
            "ALTER TABLE %s ADD CONSTRAINT `%s` FOREIGN KEY (`%s`) REFERENCES `%s` (`%s`) ON DELETE $onDelete ON UPDATE $onUpdate"
            , self::getTableStatic(), 'c_fk_' . self::getTableStatic() . '_' . $column, $column, $hookTable, $column));
    }

    static function setDefaultValue($column_name, $defaultValue)
    {
        $def = $defaultValue == null ? 'NULL' : "'$defaultValue'";
        \R::exec("ALTER TABLE `".self::getTableStatic()."` ALTER COLUMN `{$column_name}` SET DEFAULT {$def}");
    }

    public function setUnique($columns = [])
    {
        //TODO: change to wpdb;
        $b = \R::dispense(self::getTableStatic());
        $b->setMeta("buildcommand.unique", $columns);
    }

    //--------------- RELATION HELPER ----------------//
    static function OwnOneBy($by_column_name = 'id', $operator = '=', $value)
    {
        if (is_null($value) or empty($value))
            throw new \Exception("**[ wp_infinite Error : \"Can't find item, Need ID (Have you use '->readAction(*id*)' yet?)\" ]**");
        return \R::findOne(self::getTableStatic(), "{$by_column_name} {$operator} ?", [$value] );

    }

    static function ownById($id)
    {
        if (is_null($id) or empty($id))
            throw new \Exception("**[ wp_infinite Error : \"Can't find item, Need ID (Have you use '->readAction(*id*)' yet?)\" ]**");
        return \R::load(self::getTableStatic(), $id );

    }
    //-------- Private Zone --------//
}
