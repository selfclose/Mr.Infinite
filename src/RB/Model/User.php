<?php
namespace RB\Model;

use RB\Controller\RedBeanController;

/**
 * Class User
 * @package RB\Model
 * @property int id
 * @property string name
 * @property string address
 */
class User extends RedBeanController
{
    /**
     * @var Company
     */
    protected $company;

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

    /**
     * @return Company
     */
    public function getCompany()
    {
        return $this->dataModel->company;
    }

    /**
     * @param Company $company
     */
    public function setCompany($company)
    {
        \R::dispense( 'Company' );
        $this->dataModel->company = $company;
    }



}
