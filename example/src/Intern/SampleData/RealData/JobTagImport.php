<?php
namespace Intern\SampleData\RealData;

class JobTagImport
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
            $data = new \Intern\Model\jobTag();

            $data->setName($record);

            if ($data->insertAction()) {
                iLog('* Inserted Job Category: '.$record);
            }
        }
    }
}
