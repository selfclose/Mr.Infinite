<?php
namespace Intern\SampleData\RealData;

use Intern\Model\Skill;
use Intern\Model\User;
use Intern\Model\UserSkill;

class UserSkillImport
{

    function __construct()
    {
        iLog('--- Importing User Skill ---', true);

        $allUser = new User();
        $skill = new Skill();
        $allSkill = $skill->countAction();

        for($i=1;$i<$allUser->countAction();$i++) {
            $data = new UserSkill();
            $data->setUserId($i);
            $data->setSkillId(rand(1, $allSkill));
            $data->insertAction();

            iLog('* Inserted User ID: '.$i.', Skill ID: '.$data->getSkillId());

        }
    }
}
