<?php
namespace RB\Controller;

class RedBeanController
{
    protected $id;
    protected $table;
    public $dataModel;

    function __construct($id = 0)
    {
        if ($id > 0) {
            $this->id = $id;
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
        return $this->id;
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

        return \R::store($this->dataModel);
    }

    public function updateAction()
    {
        return \R::store($this->dataModel);
    }

    public function readAction()
    {
        $this->dataModel = \R::load($this->table, $this->id);
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
        return \R::trash($this->table, $this->id);
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
