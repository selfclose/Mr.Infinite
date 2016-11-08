<?php
namespace RB\Model;

use RB\Controller\RedBeanController;

/**
 * Class Company
 * @package RB\Model
 * @property int id
 * @property string name
 * @property string address
 */
class Company extends RedBeanController
{

    function __construct($tableId = 0)
    {
        $this->setTableName('company');
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
