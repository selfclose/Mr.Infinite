<?php
namespace Intern\SampleData\RealData;

use Intern\Model\UniversityType;

class UniversityTypeImport
{
    private $records = [
        [
            'name' => 'รัฐบาล',
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
        iLog('--- Importing University Type ---', true);

        foreach ($this->records as $record) {
            $data = new UniversityType();
            $data->setName($record['name']);

            $data->insertAction();
            iLog('* Inserted University Type: '.$record['name']);
        }
    }
}
