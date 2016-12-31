<?php
namespace Intern\SampleData\RealData;

use Intern\Model\Company;
use Intern\Model\CompanyDepartment;
use Intern\Model\User;

class CompanyDepartmentImport
{
    private $records = [
        [
            'name' => 'อื่นๆ',
            'name_eng' => 'Etc',
        ],
        [
            'name' => 'ฝ่ายบริหาร',
            'name_eng' => 'Management',
        ],
        [
            'name' => 'ฝ่ายกราฟฟิค ดีไซน์',
            'name_eng' => 'Graphic Designer',
        ],
        [
            'name' => 'ฝ่ายการตลาด',
            'name_eng' => 'Marketing',
        ],
        [
            'name' => 'ฝ่ายบริการ',
            'name_eng' => 'Service',
        ],
        [
            'name' => 'แผนกบัญชี',
            'name_eng' => 'Accounting',
        ],
        [
            'name' => 'แผนกบัญชี',
            'name_eng' => 'Accounting',
        ],
        [
            'name' => 'แผนกบัญชี',
            'name_eng' => 'Accounting',
        ],
    ];

    function __construct()
    {
        $company = new Company();
        $allCompany = $company->countAction();
        $user = new User();
        $allUser = $user->countAction();

        global $faker;

       iLog('--- Importing Company Department ---', true);
        foreach ($this->records as $record) {
            $data = new CompanyDepartment();

            $data->setName($record['name']);
            $data->setName($record['name_eng'], 'en');
            $data->setCompanyId(rand(1, $allCompany));
//            $data->setUser([rand(1, $allUser), rand(1, $allUser)]);
            $data->setDescription($faker->paragraph(1));
            $data->setTel([$faker->phoneNumber]);
            $data->setFax([$faker->phoneNumber]);

            if ($data->insertAction()) {
                iLog('* Inserted Department: '.$record['name']);
            }
        }
    }
}
