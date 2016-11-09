<?php
namespace Intern\Model;

use Intern\Controller\RedBeanController;

/**
 * Class Resume
 * @package Intern\Model
 * @property int id
 * @property int user
 * @property string title
 * @property int ping_company บริษัทที่จะส่ง หรือ ไม่เจาะจง
 * @property \DateTime out_date วันหมดอายุ
 * @property array type ฝึกงานประเภทอะไรบ้าง
 * @property \DateTime start_date
 * @property \DateTime end_date
 * @property string attach_url
 * @property string description
 * @property string public GLOBAL | SPECIFIC | PRIVATE
 */
class Resume extends RedBeanController
{

    function __construct($tableId = 0)
    {
        $this->tableName = 'resume';
        parent::__construct($tableId);
    }

    /**
     * @return int
     */
    public function getUser()
    {
        return $this->dataModel->user;
    }

    /**
     * @param int $user
     */
    public function setUser($user)
    {
        $this->dataModel->user = $user;
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
     * @return int
     */
    public function getPingCompany()
    {
        return $this->dataModel->ping_company;
    }

    /**
     * @param int $ping_company
     */
    public function setPingCompany($ping_company)
    {
        $this->dataModel->ping_company = $ping_company;
    }

    /**
     * @return \DateTime
     */
    public function getOutDate()
    {
        return $this->dataModel->out_date;
    }

    /**
     * @param \DateTime $out_date
     */
    public function setOutDate($out_date)
    {
        $this->dataModel->out_date = $out_date;
    }

    /**
     * @return array
     */
    public function getType()
    {
        return $this->dataModel->type;
    }

    /**
     * @param array $type
     */
    public function setType($type)
    {
        $this->dataModel->type = $type;
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
     * @return string
     */
    public function getAttachUrl()
    {
        return $this->dataModel->attach_url;
    }

    /**
     * @param string $attach_url
     */
    public function setAttachUrl($attach_url)
    {
        $this->dataModel->attach_url = $attach_url;
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
     * @return string
     */
    public function getPublic()
    {
        return $this->dataModel->public;
    }

    /**
     * @param string $public
     */
    public function setPublic($public)
    {
        $this->dataModel->public = $public;
    }
}
