<?php
namespace Intern\SampleData;

use Intern\Model\Company;
use Intern\SampleData\RealData\CompanyImport;
use Intern\SampleData\RealData\CompanyTypeImport;

class Importer
{
    function __construct()
    {
        \R::nuke();

        $geo = new \Intern\SampleData\RealData\GeoImport();
        $geo->import();

        $province = new \Intern\SampleData\RealData\ProvinceImport();
        $province->import();

        $companyType = new CompanyTypeImport();
        $companyType->import();

        $company = new CompanyImport();
        $company->import();
    }
}