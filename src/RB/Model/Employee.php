<?php
namespace RB\Model;

use RB\Controller\RedBeanController;

/**
 * Class User
 * @package RB\Model
 * @property int id
 * @property string name
 * @property int age
 * @property Company company
 */
class Employee extends RedBeanController
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

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->dataModel->age;
    }

    /**
     * @param int $age
     */
    public function setAge($age)
    {
        $this->dataModel->age = $age;
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
        $comp = new Company($company);
        $this->dataModel->company = $comp;
    }

}
