<?php
namespace Intern\Model;
use Intern\Controller\RedBeanController;

/**
 * Class Company
 * @package Intern\Model
 * @property string id
 * @property string name
 */
class CompanyType extends RedBeanController
{
    function __construct($tableId = 0)
    {
        $this->setTableName('company_type');
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
