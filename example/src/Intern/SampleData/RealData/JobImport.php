<?php
namespace Intern\SampleData\RealData;

use Intern\Model\Company;
use Intern\Model\Job;
use Intern\Model\JobTag;
use Intern\Model\JobType;
use Intern\Provider\DateTimeProvider;

class JobImport extends DateTimeProvider
{
    private $records = [
        [
            'title' => 'บริษัท intbizth  รับเด็กฝึกงานฝ่ายการเงิน',
            'date_start' => '2016-03-12 00:00:00'
        ],
        [
            'name' => 'กราฟฟิิค ดีไซน์',
            'name_eng' => 'Graphic Designer',
        ],
        [
            'name' => 'การแพทย์',
            'name_eng' => 'Medic',
        ],
        [
            'name' => 'งานบริการ',
            'name_eng' => 'Service',
        ],
        [
            'name' => 'โรงแรม',
            'name_eng' => 'Hotel',
        ],

    ];

    function __construct($loop = 10)
    {
        global $faker;

        iLog('--- Importing Job ---', true);

        $company = new Company();
        $allCompany = $company->countAction();

        $tag = new JobTag();
        $allTag = $tag->countAction();

        for ($i=0;$i<$loop;$i++) {
            $data = new Job();
            $data->setCompany(rand(1, $allCompany));
            $data->setDepartmentId(rand(1, 3));
            $data->setTitle('บริษัท '.$faker->company.' ประกาศหางาน');
            $data->setDescription($faker->paragraph(2));
            $data->setStartDate($this->getToday());
            $data->setEndDate($this->forwardFromToday(7));
            $data->setTag([1,rand(2,$allTag)]);

            if ($data->insertAction()) {
                iLog('* Inserted Job : '.$data->getTitle());
            }
        }
    }
}
