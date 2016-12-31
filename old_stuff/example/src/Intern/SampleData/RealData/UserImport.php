<?php
namespace Intern\SampleData\RealData;

use Intern\Model\Badge;
use Intern\Model\Education;
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

    protected $thaiName = [
        'อานันทชัย ชมภูชัย',
        'ทนาทร เกียรติสังหาร',
        'ประสบ อุบัติเหตุ',
        'พัดลม บินทะลุบ้าน',
        'สมหวัง บุญมาน้อย',
        'ภาสินอย หอยอารี',
        'ภทรพงษ์ เหงาจัง',
        'เกริกเกียรติ กางมุ้งคอย',
        'แม็ก โดนอม',
        'สุภาภร เจียมสังขาร',
        'ลูกแพร ไทยไหม',
        'วนาพร ป้อมปราการ',
        'จตุพร กะละมัง',
        'กนกพร เยสไอแคน',
        'ผิวผ่อง ขลำยาว',
        'สมอ เท่เสมอ',
        'วรรณคดี มีฮา',
        'พายัพ เยิน',
        'คณานัพ สะดุดตา',
        'อุดมการ เซลฟี่',
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

        $education = new Education();
        $allEducation = $education->countAction();

        $resume = new Education();
        $allResume = $resume->countAction();
        iLog('--- Importing User ---', true);

        global $faker;
        for($i=1;$i<=count($this->thaiName);$i++) {

            $data = new User();
            $data->setUsername($faker->userName);
            $data->setDisplayName($this->thaiName[$i-1]);
            $data->setImageUrl($faker->imageUrl(320, 240));
            $data->setGender($faker->randomElement(['m', 'f', 'n']));
            $data->setAddress($faker->address);
            $data->setZipcode($faker->postcode);
            $data->setProvince(rand(1, 77));
            $data->setDescription($faker->paragraph(6));
            $data->setBirthDate($faker->dateTimeBetween('-50 years', '-16 years'));
            $data->setEmail($faker->email);
            $data->setFacebook('http://www.facebook.com/'.$faker->userName);

            $data->setLine($faker->userName);
            $data->setGotJob($faker->boolean());
            $data->setWebsite([$faker->url]);
            $data->setTel($faker->phoneNumber);
            $data->setBadge([rand(1,$allBadge)]);

            $data->setSkills([rand(1, $allSkill), rand(1, $allSkill), rand(1, $allSkill)]);

            $data->setEducations([rand(1, $allEducation), rand(1, $allEducation)]);
            $data->setResumes([rand(1, $allResume), rand(1, $allResume)]);

            $data->insertAction();
            iLog($i.'. Inserted user: '.$data->getDisplayName());
        }
    }
}
