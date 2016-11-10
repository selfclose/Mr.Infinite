<?php
namespace Intern\Model;
use Intern\ConcatTrait\EnabledTrait;
use Intern\ConcatTrait\NameTrait;
use Intern\Controller\RedBeanController;

/**
 * Class Skill
 * @package Intern\Model
 * @property int id
 * @property int type_id
 * @property string name
 * @property int skillType
 */
class Skill extends RedBeanController
{
    use NameTrait;
    use EnabledTrait;

    function __construct($id = 0)
    {
        parent::__construct($id);

        $this->setEnabled(true);
    }

    /**
     * @return int SkillType
     */
    public function getSkillType()
    {
        return $this->dataModel->skilltype_id;
    }

    /**
     * @param int $type
     */
    public function setSkillType($type)
    {
        $this->dataModel->skilltype_id = $type;
    }
}
