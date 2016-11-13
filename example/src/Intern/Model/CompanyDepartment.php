<?php
namespace Intern\Model;
use Intern\ConcatTrait\NameLangTrait;
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
    use NameLangTrait;

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
    public function getUser()
    {
        return  $this->dataModel->sharedWp_users;
    }

    /**
     * @param $tagId array wp_users
     */
    public function setUser($users)
    {
        unset($this->dataModel->sharedWp_users);
        if (is_array($users)) {
            foreach ($users as $tag) {
                $this->dataModel->sharedWp_users[] = \R::load('wp_users', $tag);
            }
        }
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
