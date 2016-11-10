<?php
namespace Intern\SampleData\RealData;

use Intern\Model\JobType;

class JobTypeImport
{
    private $records = [
        [
            'name' => 'โปรแกรมเมอร์',
            'name_eng' => 'Programmer',
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

    function __construct()
    {
       iLog('--- Importing Job Type ---', true);
        foreach ($this->records as $record) {
            $geo = new JobType();

            $geo->setName($record['name']);
            $geo->setName($record['name_eng'], 'en_US');

            if ($geo->insertAction()) {
                iLog('* Inserted Job Type: '.$record['name']);
            }
        }
    }
}
