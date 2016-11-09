<?php
namespace Intern\SampleData\RealData;

use Intern\Model\CompanyType;
use Intern\Model\Geo;

class ProvinceImport
{
    private $data = [
        [
            'id' => '1',
            'name' => 'กิจการเจ้าของคนเดียว',
            'name_eng' => '',
        ],
        [
            'id' => '2',
            'name' => 'ห้างหุ้นส่วน',
            'name_eng' => '',
        ],
        [
            'id' => '3',
            'name' => 'ห้างหุ้นส่วน',
            'name_eng' => '',
        ],
        [
            'id' => '4',
            'name' => 'บริษัทจำกัด',
            'name_eng' => '',
        ],
        [
            'id' => '5',
            'name' => 'บริษัทมหาชนจำกัด',
            'name_eng' => '',
        ],
        [
            'id' => '6',
            'name' => 'สหกรณ์',
            'name_eng' => '',
        ],
        [
            'id' => '7',
            'name' => 'รัฐวิสาหกิจ',
            'name_eng' => '',
        ],
        [
            'id' => '7',
            'name' => 'บริษัทข้ามชาติ',
            'name_eng' => '',
        ],
        [
            'id' => '7',
            'name' => 'กิจการแฟรนไชส์',
            'name_eng' => 'Franchise',
        ],
    ];

    public function inject()
    {
        foreach ($this->data as $record) {
            $type = new CompanyType($record['id']);
            $type->setName($record['name']);

        }
    }
}
