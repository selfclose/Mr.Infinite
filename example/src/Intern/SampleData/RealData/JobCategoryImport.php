<?php
namespace Intern\SampleData\RealData;

class JobCategoryImport
{
    private $records = [
        'ฝึกงาน',
        'ฝึกงาน เบี้ยเลี้ยง',
        'ฝึกงาน ภาษาอังกฤษ',
        'OT',
    ];

    function __construct()
    {
       iLog('--- Importing Job Category ---', true);
        foreach ($this->records as $record) {
            $geo = new \Intern\Model\JobCategory();

            $geo->setName($record);

            if ($geo->insertAction()) {
                iLog('* Inserted Job Category: '.$record);
            }
        }
    }
}
