<?php
namespace RB\Controller;

class RedBeanController
{
    protected $tableId;
    protected $table;
    public $dataModel;

    function __construct($tableId = 0)
    {
        if ($tableId > 0) {
            $this->tableId = $tableId;
        }
        else {
            $this->dataModel = \R::dispense($this->table);
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

    /**
     * @param string $table
     */
    public function setTable($table)
    {
        $this->table = $table;
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
        $this->dataModel = \R::load($this->table, $this->tableId);
    }

    /**
     * @example  readAllAction('ORDER BY title DESC LIMIT 10');
     * @param string $AddQuery
     * @return array
     */
    public function readAllAction($AddQuery = '')
    {
        return \R::findAll($this->table, $AddQuery);
    }

    public function deleteAction()
    {
        return \R::trash($this->table, $this->tableId);
    }

    /**
     * @param string $AddQuery
     * @return int
     */
    public function countAction($AddQuery = '')
    {
        return \R::count($this->table, $AddQuery);
    }
}
