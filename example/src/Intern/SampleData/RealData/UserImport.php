<?php
namespace Intern\SampleData\RealData;

use Intern\Model\Badge;
use Intern\Model\Skill;
use Intern\Model\User;

class UserImport
{
    private $records = [
        [
            'display_name' => 'อานันทชัย',
            'gender' => 'm',
            'age' => 25,
            'address' => '8/11 ต.ต้า อ.ขุนตาล',
            'province' => 45,
            'zipcode' => '57340',
            'tel' => '091-142-7991',
            'facebook' => 'http://www.facebook.com/selfclose',
            'line' => 'shabooshaboo',
            'description' => 'ทดสอบครับ ยาวๆ เลยพี่น้อง',
        ],
    ];

    function __construct()
    {
//        foreach ($this->records as $record) {
//            $data = new User();
//            $data->setDisplayName($record['display_name']);
//            $data->setGender($record['gender']);
//            $data->setAge($record['age']);
//            $data->insertAction();
//        }

        $skill = new Skill();
        $allSkill = $skill->countAction();

        $badge = new Badge();
        $allBadge = $badge->countAction();

        iLog('--- Importing User ---', true);

        global $faker;
        for($i=1;$i<20;$i++) {

            $data = new User();
            $data->setUsername($faker->userName);
            $data->setDisplayName($faker->name);
            $data->setImageUrl($faker->imageUrl(320, 240));
            $data->setGender($faker->randomElement(['m', 'f', 'n']));
            $data->setAddress($faker->address);
            $data->setZipcode($faker->postcode);
            $data->setProvinceId(rand(1, 77));
            $data->setDescription($faker->paragraph(6));
            $data->setBirthDate($faker->dateTime);
            $data->setEmail($faker->email);
            $data->setFacebook('http://www.facebook.com/'.$faker->userName);

            $data->setLine($faker->userName);
            $data->setGotJob($faker->boolean());
            $data->setWebsite([$faker->url]);
            $data->setTel($faker->phoneNumber);
            $data->setBadge([rand(1,$allBadge)]);

            $data->setSkills([rand(1, $allSkill), rand(1, $allSkill), rand(1, $allSkill)]);
            $data->setResumes([$i]);

            $data->insertAction();
            iLog($i.'. Inserted user: '.$data->getDisplayName());
        }
    }
}
