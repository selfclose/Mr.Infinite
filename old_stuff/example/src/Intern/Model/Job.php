<?php
namespace Intern\Model;

use Intern\ConcatTrait\EnabledTrait;
use Intern\Controller\RedBeanController;

/**
 * @property int id
 * @property string title
 * @property array sharedJobtag
 * @property int company_id
 * @property int companydepartment_id
 * @property string description
 */
class Job extends RedBeanController
{
    use EnabledTrait;

    protected $table = 'job';

    function __construct($id = 0)
    {
        parent::__construct($id);

        //default value
        $this->setEnabled(true);
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
     * @return Company
     */
    public function getCompany()
    {
//        return \R::load('company', $this->dataModel->company_id);
        return $this->dataModel->company_id;
    }

    /**
     * @param string $company_id
     */
    public function setCompany($company_id)
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
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->dataModel->start_date;
    }

    /**
     * @param \DateTime $start_date
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

    /**
     * @return array
     */
    public function getTag()
    {
        return  $this->dataModel->sharedJobtag;
    }

    /**
     * @param $tagId array JobTag
     */
    public function setTag($tags)
    {
        unset($this->dataModel->sharedJobtag);
        if (is_array($tags)) {
            foreach ($tags as $tag) {
                $this->dataModel->sharedJobtag[] = \R::load('jobtag', $tag);
            }
        }
    }

    /**
     * @param $tagId int JobTag
     */
    public function addTag($tagId)
    {
        $this->dataModel->sharedJobtag[] = \R::load('jobtag', $tagId);
    }
}
