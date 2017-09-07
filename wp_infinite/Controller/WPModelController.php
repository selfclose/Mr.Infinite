<?php
namespace wp_infinite\Controller;

use wp_infinite\Model\WPUsers;

class WPModelController
{
    protected $table;
    protected $ID;
    protected $timestamp = true;

    //    function __construct()
    //    {
    //        global $wpdb;
    //        $this->wpdb = $wpdb;
    //
    //        //if you not override $table, it will use class name as table's name
    //        if (empty($this->table)) {
    //            $ex = explode("\\", get_called_class());
    //            $this->table = strtolower($ex[count($ex)-1]);
    //        }
    //    }

    /**
     * @return int
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param string $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * @return string
     */
    private static function getTableStatic() {
        $class = get_called_class();
        if ($class == WPUsers::class) {
            global $wpdb;
            return $wpdb->users;
        }

        $table = strtolower(get_class_vars($class)['table']);
        if (empty($table)) {
            return strtolower(substr($class, strripos($class, '\\') + 1));
        }
        return $table;
    }

    //TODO: insertAction

    public function readAction($id)
    {
        $data = self::find($id);
        foreach ($data as $key => $val) {
            $this->{$key} = $val;
        }
    }

    public function updateAction()
    {
        if (is_null($this->ID))
            die("** WP_INFINITE ERROR ** : Update Need to readAction it First.");

        $props = array_diff_key(get_object_vars($this), array_flip(['table', 'dataModel', 'ID']));
        $concat_key = "";
        $concat_val = "";

        foreach ($props as $key=>$val) {
            if (is_null($val))
                unset($props[$key]);
            else {
                if (empty($concat_key)) {
                    $concat_key .= $key;
                    $concat_val .= $val;
                }
                else {
                    $concat_key .= ', ' . $key;
                    $concat_val .= ', ' . $val;
                }
            }
        }
    }

    static function find($id)
    {
        global $wpdb;
        return $wpdb->get_row("SELECT * FROM ".self::getTableStatic()." WHERE ID = '{$id}'");
    }

    /**
     * @return int
     */
    static function count()
    {
        global $wpdb;
        return $wpdb->get_var("SELECT COUNT(*) FROM ".self::getTableStatic());
    }


    static function findOneBy($column = 'id', $keyword)
    {
        global $wpdb;
        $keyword = wp_strip_all_tags($keyword);
        return $wpdb->get_row("SELECT * FROM ".self::getTableStatic()." WHERE {$column} = '{$keyword}'");
    }

    /**
     * @param string $orderBy
     * @param bool $sortReverse
     * @param int $limit
     * @return object
     */
    static function findAll($orderBy = '', $sortReverse = false, $limit = 0)
    {
        global $wpdb;
        $concat = '';
        if ($orderBy!='')
            $concat.=' ORDER BY '.$orderBy.' '.($sortReverse?'DESC':'ASC');
        if ($limit > 0)
            $concat.=' LIMIT '.$limit;
        return $wpdb->get_results("SELECT * FROM ".self::getTable()."{$concat}");
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
        global $wpdb;
        return $wpdb->get_row("SELECT (SELECT COUNT(*) FROM ".self::getTableStatic()." WHERE {$column} " .($sortReverse?"<=":">=")." '{$find}') AS position FROM ".self::getTableStatic()." WHERE {$column} = '{$find}'")->position;
    }

    public function query($query_command)
    {
        global $wpdb;
        return $wpdb->get_results($query_command);
    }

    /**
     * @param string $findBy
     * @param $keyword
     * @param string $orderBy
     * @param bool $sortReverse
     * @param string $limit
     * @return array
     */
    static function findLike($findBy = 'id', $keyword, $orderBy = 'id', $sortReverse = false, $limit = '')
    {
        if (substr($keyword, 0, 1) != '%' and substr($keyword, strlen($keyword)-1, 1) != "%")
            $keyword = "%{$keyword}%";

        global $wpdb;
        $concat = ' ORDER BY ' . $orderBy . ' ' . ($sortReverse ? 'DESC' : 'ASC');
        if ($limit != '')
            $concat .= ' LIMIT ' . $limit;

        return $wpdb->get_results("SELECT * FROM ".self::getTableStatic()." WHERE {$findBy} LIKE '{$keyword}'{$concat}");
    }

    /**
     * @param $column_name
     * @param $comment
     * @return bool|int
     */
    static function setColumnComment($column_name, $comment)
    {
        global $wpdb;
        $type = $wpdb->get_row("SHOW FIELDS FROM ".self::getTableStatic()." WHERE FIELD ='{$column_name}'")->Type;
        return $wpdb->query("ALTER TABLE `".self::getTableStatic()."` CHANGE `{$column_name}` `{$column_name}` {$type} COMMENT '{$comment}'");
    }

}
