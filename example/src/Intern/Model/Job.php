<?php
namespace Intern\Model;

use Intern\ConcatTrait\NameTrait;
use Intern\Controller\RedBeanController;

/**
 * Class Job
 * @package Intern\Model
 * @property string name
 * @property int company_id
 * @property int companydepartment_id
 * @property int jobtype_id
 * @property string description
 */
class Job extends RedBeanController
{
    function __construct($id = 0)
    {
        parent::__construct($id);
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->dataModel->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->dataModel->title = $title;
    }

     /**
     * @return string
     */
    public function getCompanyId()
    {
        return $this->dataModel->company_id;
    }

    /**
     * @param string $company_id
     */
    public function setCompanyId($company_id)
    {
        $this->dataModel->company_id = $company_id;
    }



    /**
     * @return mixed
     */
    public function getJobcategoryId()
    {
        return $this->dataModel->jobcategory_id;
    }

    /**
     * @param mixed $jobcategory_id
     */
    public function setJobcategoryId($jobcategory_id)
    {
        $this->dataModel->jobcategory_id = $jobcategory_id;
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
    public function getDepartmentId()
    {
        return $this->dataModel->companydepartment_id;
    }

    /**
     * @param int $department_id
     */
    public function setDepartmentId($department_id)
    {
        $this->dataModel->companydepartment_id = $department_id;
    }

    /**
     * @return int
     */
    public function getStartDate()
    {
        return $this->dataModel->start_date;
    }

    /**
     * @param mixed $start_date
     */
    public function setStartDate($start_date)
    {
        $this->dataModel->start_date = $start_date;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->dataModel->end_date;
    }

    /**
     * @param \DateTime $end_date
     */
    public function setEndDate($end_date)
    {
        $this->dataModel->end_date = $end_date;
    }
}
