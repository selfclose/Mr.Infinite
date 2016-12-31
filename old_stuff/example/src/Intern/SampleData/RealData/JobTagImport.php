<?php
namespace Intern\SampleData\RealData;

use Intern\Model\JobTag;

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
            $data = new JobTag();

            $data->setName($record);

            if ($data->insertAction()) {
                iLog('* Inserted Job Category: '.$record);
            }
        }
    }
}
