<?php
namespace Intern\SampleData\RealData;

use Intern\Model\Company;
use Intern\Model\EducationDegree;
use Intern\Model\EducationMajor;
use Intern\Model\Job;
use Intern\Model\JobTag;
use Intern\Model\JobType;
use Intern\Provider\DateTimeProvider;

class EducationDegreeImport extends DateTimeProvider
{
    private $records =
        [
            [
                'en' => 'Vocational Certificate',
                'th' => 'ปวช.',
            ],
            [
                'en' => 'High Vocational Certificate',
                'th' => 'ปวส.',
            ],
            [
                'en' => 'Technical Certificate',
                'th' => 'ปวท.',
            ],
            [
                'en' => 'Bachelor of Arts',
                'th' => 'ปริญญาตรี',
            ],
            [
                'en' => 'Master of Arts',
                'th' => 'ปริญญาโท',
            ],
            [
                'en' => 'Doctor of Philosophy',
                'th' => 'ปริญญาเอก',
            ],
        ];

    function __construct()
    {
        iLog('--- Importing Degree ---', true);

        foreach ($this->records as $record) {
            $data = new EducationDegree();
            $data->setName($record['th']);
            $data->setName($record['en'], 'en');

            if ($data->insertAction()) {
                iLog('* Inserted Degree : '.$data->getName());
            }
        }
    }
}
