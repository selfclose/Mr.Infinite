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

    function __construct($id = 0)
    {
        parent::__construct($id);
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
