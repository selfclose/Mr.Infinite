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
        echo "<hr/><p>--- Importing University Type ---</p>";

        foreach ($this->records as $record) {
            $data = new UniversityType();
            $data->setName($record['name']);

            $data->insertAction();
            echo "<p>*. Inserted University Type: {$record['name']}</p>";
        }
    }
}
