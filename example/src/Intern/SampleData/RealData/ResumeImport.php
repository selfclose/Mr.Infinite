<?php
namespace Intern\SampleData\RealData;

use Intern\Model\Company;
use Intern\Model\Resume;
use Intern\Model\User;

class ResumeImport
{
    private $records = [
        [
            'user_id' => 1,
        ],
        [
            'name' => 'มหาวิทยาลัยเปิด',
        ],
        [
            'name' => 'มหาวิทยาลัยราชภัฏ',
        ],
        [
            'name' => 'มหาวิทยาลัยเอกชน',
        ],
        [
            'name' => 'มหาวิทยาลัยเทคโนโลยีราชมงคล',
        ],
    ];

    function __construct()
    {
        iLog('--- Importing Resume ---', true);

        $user = new User();
        $allUser = $user->countAction();

        $company = new Company();
        $allCompany = $company->countAction();

        global $faker;

        for ($i=1;$i<10;$i++) {
            $data = new Resume();
            $data->setUserId(rand(1, $allUser));
            $data->setTitle($faker->name);
            $data->setPingCompanyId(rand(1, $allCompany));
            $data->setDescription($faker->paragraph(1));
            $data->setPublic($faker->randomElement([Resume::PUBLIC_GLOBAL, Resume::PUBLIC_PRIVATE, Resume::PUBLIC_SPECIFIC]));
            $data->setEndDate($faker->dateTimeThisMonth);
            $data->setAttachUrl($faker->url);

            $data->insertAction();
            iLog('Inserted Resume: '.$data->getTitle());
        }
    }
}
