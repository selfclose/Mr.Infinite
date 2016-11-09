<?php
namespace Intern\Model;
use Intern\Controller\RedBeanController;

/**
 * Class Skill
 * @package Intern\Model
 * @property int id
 * @property int user_id
 * @property int skill_id
 */
class UserResume extends RedBeanController
{
    protected $resume_id;

    function __construct($id = 0)
    {
        parent::__construct($id);
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->dataModel->wp_users_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId($user_id)
    {
        $this->dataModel->wp_users_id = $user_id;
    }

    /**
     * @return int
     */
    public function getSkillId()
    {
        return $this->dataModel->skill_id;
    }

    /**
     * @param int $skill_id
     */
    public function setSkillId($skill_id)
    {
        $this->dataModel->skill_id = $skill_id;
    }
}
