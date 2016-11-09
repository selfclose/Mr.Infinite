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
class UserSkill extends RedBeanController
{
    protected $table = 'userskill';

    function __construct($Id)
    {
        parent::__construct($Id);
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->dataModel->wp_users;
    }

    /**
     * @param int $user_id
     */
    public function setUserId($user_id)
    {
        $this->dataModel->user_id[] = $user_id;
    }

    /**
     * @return int
     */
    public function getSkillId()
    {
        return $this->skill_id;
    }

    /**
     * @param int $skill_id
     */
    public function setSkillId($skill_id)
    {
        $this->skill_id = $skill_id;
    }


}
