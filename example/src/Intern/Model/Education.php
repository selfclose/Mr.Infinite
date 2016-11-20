<?php
namespace Intern\Model;

use Intern\ConcatTrait\EnabledTrait;
use Intern\ConcatTrait\NameTrait;
use Intern\Controller\RedBeanController;

/**
 * @property int id
 * @property User user
 * @property string degree
 * @property int university
 * @property int GPA
 * @property \DateTime start_year
 * @property \DateTime end_year
 * @property int honour = 0 เกีรตินินม
 *
 * @property string description
 */
class Education extends RedBeanController
{
    const DEGREE_Diploma = 'dip'; //อนุปริญญา
    const DEGREE_Bachelor = 'bac'; //ปริญญาตรี
    const DEGREE_Masters = 'mas'; //ปริญญาโท
    const DEGREE_Doctoral = 'doc'; //ปริญญาโท


    function __construct($id = 0)
    {
        parent::__construct($id);

        $this->dataModel->honour = 0;
    }

    //TODO: mis understanding move please
    /**
     * @return User
     */
    public function getUser()
    {
        return $this->dataModel->ownWp_user;
    }

    /**
     * @param User $user_id
     */
    public function setUser($user_id)
    {
        $this->dataModel->wp_users_id = $user_id;
    }

    /**
     * @return int
     */
    public function getDegree()
    {
        return $this->dataModel->degree;
    }

    /**
     * @param string $degree
     */
    public function setDegree($degree)
    {
        $this->dataModel->degree = $degree;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return University
     */
    public function getUniversity()
    {
        return new University($this->dataModel->sharedUniversity);
    }

    /**
     * @param $university_id array University
     */
    public function setUniversity($university_id)
    {
        $this->dataModel->university_id = $university_id;
    }

    /**
     * @return int
     */
    public function getGPA()
    {
        return $this->dataModel->GPA;
    }

    /**
     * @param int $GPA
     */
    public function setGPA($GPA)
    {
        $this->dataModel->GPA = $GPA;
    }

    /**
     * @return \DateTime
     */
    public function getStartYear()
    {
        return $this->dataModel->start_year;
    }

    /**
     * @param \DateTime $start_year
     */
    public function setStartYear($start_year)
    {
        $this->dataModel->start_year = $start_year;
    }

    /**
     * @return \DateTime
     */
    public function getEndYear()
    {
        return $this->dataModel->end_year;
    }

    /**
     * @param \DateTime $end_year
     */
    public function setEndYear($end_year)
    {
        $this->dataModel->end_year = $end_year;
    }

    /**
     * @return int
     */
    public function getHonour()
    {
        return $this->dataModel->honour;
    }

    /**
     * @param int $honour
     */
    public function setHonour($honour)
    {
        $this->dataModel->honour = $honour;
    }
}
