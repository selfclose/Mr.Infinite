<?php
namespace Intern\Model;
use Intern\ConcatTrait\NameTrait;
use Intern\Controller\RedBeanController;

/**
 * Class Company
 * @package Intern\Model
 * @property int id
 * @property string name
 * @property string description
 * @property int company_id
 * @property array wp_user_id
 * @property array tel
 * @property array fax
 */
class CompanyDepartment extends RedBeanController
{
    use NameTrait;

    function __construct($id = 0)
    {
        parent::__construct($id);
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->dataModel->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->dataModel->description = $description;
    }

    /**
     * @return int
     */
    public function getCompanyId()
    {
        return $this->dataModel->company_id;
    }

    /**
     * @param int $company_id
     */
    public function setCompanyId($company_id)
    {
        $this->dataModel->company_id = $company_id;
    }

    /**
     * @return array
     */
    public function getUserId()
    {
        return $this->dataModel->wp_users_id;
    }

    /**
     * @param array $wp_user_id
     */
    public function setUserId($wp_users_id)
    {
        $this->dataModel->wp_users_id = $wp_users_id;
    }

    /**
     * @return array
     */
    public function getTel()
    {
        return unserialize($this->dataModel->tel);
    }

    /**
     * @param array $tel
     */
    public function setTel($tel)
    {
        $this->dataModel->tel = serialize($tel);
    }

    /**
     * @return array
     */
    public function getFax()
    {
        return unserialize($this->dataModel->fax);
    }

    /**
     * @param array $fax
     */
    public function setFax($fax)
    {
        $this->dataModel->fax = serialize($fax);
    }
}
