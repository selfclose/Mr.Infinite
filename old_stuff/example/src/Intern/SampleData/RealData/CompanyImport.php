<?php
namespace Intern\SampleData\RealData;

use Intern\Config\Table;
use Intern\Model\Company;
use Intern\Model\CompanyType;

class CompanyImport
{
    private $records = [
        [
            'account_type' => Company::ACCOUNT_PREMIUM,
            'name' => 'บริษัท intbizth',
            'company_type' => 5,
            'founder' => 'พี่มิกซ์',
            'description' => 'บริษัท Software',
            'start_date' => '2016-03-01',
            'province_id' => 1,
            'tel' => ['091-123-9594 พี่มิกซ์', '091-255-1111'],
            'fax' => ['02-343-4444'],
            'open_date' => [], //later
            'close_date' => [], //later
            'address' => '2/119 หมู่บ้าน Villa ซอยมิสทีน บลาๆๆๆๆ',
            'zipcode' => '52000',
            'google_map' => '0.243,0.888',
            'wallet' => 120,
            'end_package_date' => '2018-03-01',
            'facebook' => 'http://www.facebook.com/intbizth/',
            'website' => 'http://www.intbizth.com',
            'clicked' => 0,
            'rating' => 4.5,
        ],
        [
            'account_type' => Company::ACCOUNT_FREE,
            'name' => 'HappyFresh (Thailand) Co., Ltd.',
            'company_type' => 5,
            'founder' => 'ใครวะ',
            'description' => 'บริษัท Software',
            'start_date' => '2016-03-01',
            'province_id' => 1,
            'tel' => ['091-123-9594 พี่มิกซ์', '091-255-1111'],
            'fax' => ['02-343-4444'],
            'open_date' => [], //later
            'close_date' => [], //later
            'address' => '2/119 หมู่บ้าน Villa ซอยมิสทีน บลาๆๆๆๆ',
            'zipcode' => '78666',
            'google_map' => '0.243,0.888',
            'wallet' => 3200,
            'end_package_date' => '2018-03-01',
            'facebook' => 'http://www.facebook.com/intbizth/',
            'website' => 'http://www.intbizth.com',
            'clicked' => 0,
            'rating' => 4.5,
        ],
    ];

    function __construct()
    {
        global $faker;

        $comp_type = new CompanyType();
        $all_comp_type = $comp_type->countAction();

        iLog('--- Importing Company ---', true);

        for ($i=0; $i<10;$i++) {
            $data = new Company();

            $data->timestamp = true;

            $data->setAccountType($faker->randomElement([Company::ACCOUNT_FREE, Company::ACCOUNT_PREMIUM, Company::ACCOUNT_VIP]));
            $data->setName('บริษัท '.$faker->company);
            $data->setImageUrl($faker->imageUrl(320, 240));
            $data->setType(rand(1, $all_comp_type));
            $data->setFounder($faker->firstName);
            $data->setDescription($faker->paragraph(7));
            $data->setStartDate($faker->dateTimeBetween('-10 years', '-1 years'));
            $data->setProvinceId(rand(1, \R::count(Table::province)));
            $data->setTel($faker->phoneNumber);
            $data->setFax($faker->phoneNumber);

            $data->setEndPackageDate($faker->dateTimeBetween('-1 years', '1 years'));
            $data->setFacebook('https://www.facebook.com/'.$faker->userName);
            $data->setWebsite($faker->domainName);
            $data->setClicked(rand(1, 5000));
            $data->setRating(rand(1, 10));

            if($data->insertAction(true))
                iLog('* Inserted company: '.$i);
        }
        /*
        foreach ($this->records as $record) {
            $data = new Company();

            $data->timestamp = true;

            $data->setAccountType($record['account_type']);
            $data->setName($record['name']);
            $data->setImageUrl($faker->imageUrl(320, 240));
            $data->setType($record['company_type']);
            $data->setFounder($record['founder']);
            $data->setDescription($record['description']);
            $date = new \DateTime($record['start_date']);
            $data->setStartDate($date);
            $data->setProvinceId($record['province_id']);
            $data->setTel($record['tel']);
            $data->setFax($record['fax']);

            $date = new \DateTime($record['end_package_date']);
            $data->setEndPackageDate($date);
            $data->setFacebook($record['facebook']);
            $data->setWebsite(($record['website']));
            $data->setClicked($record['clicked']);
            $data->setRating($record['rating']);

            if($data->insertAction(true))
                iLog('* Inserted: '.$record['name']);
        }*/
    }
}
