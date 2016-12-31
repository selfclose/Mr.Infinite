<?php
namespace Intern\SampleData\RealData;

use Intern\Model\University;
use Intern\Model\User;

class UniversityImport
{
    /**
     * @see http://teen.mthai.com/education/40658.html
     */

    //TODO: fix province_id
    private $records = [
        [
            'name' => 'จุฬาลงกรณ์มหาวิทยาลัย',
            'name_eng' => 'Chulalongkorn University',
            'type' => 1,
            'website' => 'http://www.ku.ac.th',
            'province_id' => 1,
        ],
        [
            'name' => 'มหาวิทยาลัยเกษตรศาสตร์',
            'name_eng' => 'Kasetsart University',
            'type' => 1,
            'website' => 'http://www.ku.ac.th',
            'province_id' => 1,
        ],
        [
            'name' => 'มหาวิทยาลัยธรรมศาสตร์',
            'name_eng' => 'Thammasat University',
            'type' => 1,
            'website' => 'http://www.tu.ac.th',
            'province_id' => 1,
        ],
        [
            'name' => 'มหาวิทยาลัยศรีนครินวิโรฒ',
            'name_eng' => 'Srinakharinwirot University',
            'type' => 1,
            'website' => 'http://www.swu.ac.th',
            'province_id' => 1,
        ],
        [
            'name' => 'สถาบันบัณฑิตพัฒนบริหารศาสตร์',
            'name_eng' => 'National Institute of Development Administration',
            'type' => 1,
            'website' => 'http://www.nida.ac.th',
            'province_id' => 1,
        ],
        [
            'name' => 'สถาบันเทคโนโลยีพระจอมเกล้าพระนครเหนือ',
            'name_eng' => 'King Mongkut’s Institute of Technology North Bangkok',
            'type' => 1,
            'website' => 'http://www.kmitnb.ac.th',
            'province_id' => 1,
        ],
        [
            'name' => 'มหาวิทยาลัยมหิดล',
            'name_eng' => 'Mahidol University',
            'type' => 1,
            'website' => 'http://www.mahidol.ac.th',
            'province_id' => 1,
        ],
        [
            'name' => 'มหาวิทยาลัยศิลปากร',
            'name_eng' => 'Silpakoen University',
            'type' => 1,
            'website' => 'http://www.su.ac.th',
            'province_id' => 1,
        ],
        [
            'name' => 'มหาวิทยาลัยบูรพา',
            'name_eng' => 'Burapha University',
            'type' => 1,
            'website' => 'http://www.buu.ac.th',
            'province_id' => 1,
        ],
        [
            'name' => 'มหาวิทยาลัยนเรศวร',
            'name_eng' => 'Naresuan University',
            'type' => 1,
            'website' => 'http://www.nu.ac.th',
            'province_id' => 1,
        ],
        [
            'name' => 'มหาวิทยาลัยแม่โจ้',
            'name_eng' => 'Maejo University',
            'type' => 1,
            'website' => 'http://www.mju.ac.th',
            'province_id' => 1,
        ],
        [
            'name' => 'มหาวิทยาลัยเชียงใหม่',
            'name_eng' => 'Chiang Mai University',
            'type' => 1,
            'website' => 'http://www.mahidol.ac.th',
            'province_id' => 1,
        ],
        [
            'name' => 'มหาวิทยาลัยขอนแก่น',
            'name_eng' => 'Khon Kaen University',
            'type' => 1,
            'website' => 'http://www.kku.ac.th',
            'province_id' => 1,
        ],
        [
            'name' => 'มหาวิทยาลัยอุบลราชธานี',
            'name_eng' => 'Ubon Ratchathani University',
            'type' => 1,
            'website' => 'http://www.ubu.ac.th',
            'province_id' => 1,
        ],
        [
            'name' => 'มหาวิทยาลัยมหาสารคาม',
            'name_eng' => 'Mahasarakham University',
            'type' => 1,
            'website' => 'http://www.msu.ac.th',
            'province_id' => 1,
        ],
        [
            'name' => 'มหาวิทยาลัยสงขลานครินทร์',
            'name_eng' => 'Prince of Songkls University',
            'type' => 1,
            'website' => 'http://www.psu.ac.th',
            'province_id' => 1,
        ],
        [
            'name' => 'มหาวิทยาลัยทักษิณ',
            'name_eng' => 'Thaksin University',
            'type' => 1,
            'website' => 'http://www.tsu.ac.th',
            'province_id' => 1,
        ],
        [
            'name' => 'มหาวิทยาลัยนราธิวาสราชนครินทร์',
            'name_eng' => 'Princess of Narathiwat University',
            'type' => 1,
            'website' => 'http://www.pnu.ac.th',
            'province_id' => 1,
        ],

    ];

    function __construct()
    {
        iLog('--- Importing Universiry ---', true);

        foreach ($this->records as $record) {
            $data = new University();
            $data->setName($record['name']);
            $data->setName($record['name_eng'], 'en');
            $data->setType($record['type']);
            $data->setProvinceId($record['province_id']);
            $data->setWebsite($record['website']);

            $data->insertAction();
            iLog('* Inserted University: '.$record['name']);
        }
    }
}
