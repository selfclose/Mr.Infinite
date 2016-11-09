<?php
namespace Intern\SampleData;

use Intern\SampleData\RealData\CompanyImport;
use Intern\SampleData\RealData\CompanyTypeImport;
use Intern\SampleData\RealData\GeoImport;
use Intern\SampleData\RealData\ProvinceImport;
use Intern\SampleData\RealData\UserImport;

class Importer
{
    function __construct()
    {
        global $faker;
        $faker = \Faker\Factory::create();

//        \R::nuke();
//
//        new GeoImport();
//        new ProvinceImport();
//        new CompanyTypeImport();
//        new CompanyImport();
        new UserImport();
    }
}
