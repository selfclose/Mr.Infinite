<?php
namespace Intern\SampleData\RealData;

use Intern\Model\Company;
use Intern\Model\Resume;
use Intern\Model\User;

class ResumeImport
{

    function __construct($loop = 10)
    {
        iLog('--- Importing Resume ---', true);

        $user = new User();
        $allUser = $user->countAction();

        $company = new Company();
        $allCompany = $company->countAction();

        global $faker;

        for ($i=1;$i<$loop;$i++) {
            $data = new Resume();
            $data->timestamp = true;
//            $data->setUser(rand(1, $allUser));
            $data->setTitle($faker->name);
            $data->setPingCompanyId(rand(1, $allCompany));
            $data->setDescription($faker->paragraph(1));
            $data->setPublic($faker->randomElement([Resume::PUBLIC_GLOBAL, Resume::PUBLIC_PRIVATE, Resume::PUBLIC_SPECIFIC]));
            $data->setStartDate($faker->dateTimeThisMonth);
            $data->setEndDate($faker->dateTimeBetween('2 months', '6 months'));
            $data->setAttachUrl($faker->url);
            $data->setStatus($faker->randomElement([Resume::STATUS_APPROVE, Resume::STATUS_PENDING, Resume::STATUS_REJECT]));

            $data->insertAction();
            iLog('* Inserted Resume: '.$data->getTitle());
        }
    }
}
