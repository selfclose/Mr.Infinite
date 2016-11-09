<?php
namespace Intern\SampleData\RealData;

use Intern\Model\Skill;
use Intern\Model\User;
use Intern\Model\UserSkill;

class UserSkillImport
{

    function __construct()
    {
        echo "<hr/><p>--- Importing User Skill ---</p>";

        $allUser = new User();
        $skill = new Skill();
        $allSkill = $skill->countAction();

        for($i=1;$i<$allUser->countAction();$i++) {
            $data = new UserSkill();
            $data->setUserId($i);
            $data->setSkillId(rand(1, $allSkill));
            $data->insertAction();

            echo "<p>* Inserted User ID: {$i}, Skill ID: {$data->getSkillId()}</p>";
        }
    }
}
