<?php
namespace Intern\SampleData;

use Intern\SampleData\RealData\CompanyDepartmentImport;
use Intern\SampleData\RealData\CompanyImport;
use Intern\SampleData\RealData\CompanyTypeImport;
use Intern\SampleData\RealData\GeoImport;
use Intern\SampleData\RealData\JobCategoryImport;
use Intern\SampleData\RealData\ProvinceImport;
use Intern\SampleData\RealData\ResumeImport;
use Intern\SampleData\RealData\SkillImport;
use Intern\SampleData\RealData\UniversityImport;
use Intern\SampleData\RealData\UniversityTypeImport;
use Intern\SampleData\RealData\UserImport;
use Intern\SampleData\RealData\UserSkillImport;

class Importer
{
    function __construct()
    {
        global $faker;
        $faker = \Faker\Factory::create();

        \R::nuke(); //purge all tables

        //order by priority
        new GeoImport();
        new ProvinceImport();
        new CompanyTypeImport();
        new CompanyImport();
        new SkillImport();
        new UserImport();
        new UserSkillImport();
        new CompanyDepartmentImport(); //need company & user
        new UniversityTypeImport();
        new UniversityImport();
        new ResumeImport();
        new JobCategoryImport();
    }
}
