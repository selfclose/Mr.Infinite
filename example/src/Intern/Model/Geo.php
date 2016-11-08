<?php
namespace Intern\Model;
use Intern\Controller\RedBeanController;

/**
 * Class Geo
 * @package Intern\Model
 * @property string name
 */
class Geo extends RedBeanController
{
    function __construct($tableId = 0)
    {
        $this->tableName = 'geo';
        parent::__construct($tableId);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->dataModel->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->dataModel->name = $name;
    }

}
