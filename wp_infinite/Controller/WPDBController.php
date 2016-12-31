<?php
namespace wp_infinite\Controller;

class WPDBController
{
    protected $wpdb;
    protected $table;

    function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;

        //if you not override $table, it will use class name as table's name
        if (empty($this->table)) {
            $ex = explode("\\", get_called_class());
            $this->table = strtolower($ex[count($ex)-1]);
        }
    }

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param mixed $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    public function findOne($find, $column = 'id')
    {
        return $this->wpdb->get_row("SELECT * FROM {$this->getTable()} WHERE {$column} = {$find}");
    }

    /**
     * @param string $orderBy
     * @param bool $sortReverse
     * @param string $limit
     * @return object
     */
    public function findAll($orderBy = '', $sortReverse = false, $limit = '')
    {
        $concat = '';
        if ($orderBy!='')
            $concat.=' ORDER BY '.$orderBy.' '.($sortReverse?'DESC':'ASC');
        if ($limit!='')
            $concat.=' LIMIT '.$limit;
        return $this->wpdb->get_results("SELECT * FROM {$this->getTable()}{$concat}");
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
        return $this->wpdb->get_row("SELECT (SELECT COUNT(*) FROM {$this->getTable()} WHERE {$column} " .($sortReverse?"<=":">=")." '{$find}') AS position FROM {$this->getTable()} WHERE {$column} = '{$find}'")->position;
    }

}
