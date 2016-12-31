<?php
namespace Intern\Model;

use Intern\ConcatTrait\NameTrait;
use Intern\Controller\RedBeanController;

/**
 * Class SkillType
 * @package Intern\Model
 * @property int|array id
 * @property string name
 * @property array sharedSkill
 */
class SkillType extends RedBeanController
{
    use NameTrait;

    function __construct($id = 0)
    {
        parent::__construct($id);
    }

    /**
     * @return array
     */
    public function getSkills()
    {
        return $this->dataModel->sharedSkill;
    }

    /**
     * @param $skills array Skill
     */
    public function setSkills($skills)
    {
        unset($this->dataModel->sharedSkill);
        if (is_array($skills)) {
            foreach ($skills as $skill) {
                $this->dataModel->sharedSkill[] = \R::load('skill', $skill);
            }
        }
    }

    public function addSkill($skill)
    {
        $this->dataModel->sharedSkill[] = \R::load('skill', $skill);
        iLog($skill);
    }
}
