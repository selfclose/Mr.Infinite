<?php
namespace Intern\SampleData\RealData;

use Intern\Model\University;
use Intern\Model\User;

class UniversityImport
{
    private $records = [
        [
            'name' => 'มหาวิทยาลัยราชภัฏเชียงราย',
            'name_eng' => 'Chiang rai Rajabhat University',
            'short_name' => 'CRRU',
            'short_name_eng' => 'ม.ร.ช.',
            'website' => 'http://crru.org',
            'province_id' => 54,
        ],
        [
            'name' => 'มหาวิทยาลัยราชภัฏเพะเยา',
            'name_eng' => 'Payao Rajabhat University',
            'short_name' => 'PRU',
            'short_name_eng' => 'พ.ร.ช.',
            'website' => 'http://prru.org',
            'province_id' => 53,
        ],
    ];

    function __construct()
    {
        echo "<hr/><p>--- Importing University ---</p>";

        foreach ($this->records as $record) {
            $data = new University();
            $data->setName($record['name']);
            $data->setName($record['name_eng'], 'en_US');
            $data->setProvinceId($record['province_id']);
            $data->setShortName($record['short_name']);
            $data->setShortNameEng($record['short_name_eng']);
            $data->setWebsite($record['website']);

            $data->insertAction();
            echo "<p>*. Inserted University: {$record['name']}</p>";
        }
    }
}
