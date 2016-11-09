<?php
namespace Intern\SampleData\RealData;

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
        echo "<hr/><p>--- Importing User ---</p>";

        global $faker;
        for($i=1;$i<6;$i++) {
            echo "<p>user loop: ".$i."</p>";
            $data = new User();
            $data->setDisplayName($faker->name);
            $data->setGender($faker->randomElement(['m', 'f', 'n']));
            $data->setAge(rand(16, 50));
            $data->setAddress($faker->address);
            $data->setZipcode($faker->postcode);
            $data->setProvinceId(rand(1, 77));
            $data->setDescription($faker->paragraph(1));
            $data->setBirthDate($faker->dateTime);
            $data->setEmail($faker->email);
            $data->setFacebook('http://www.facebook.com/'.$faker->userName);
            $data->setLine($faker->userName);
            $data->setGotJob($faker->boolean());

            $data->insertAction();
        }
    }
}