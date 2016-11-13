<?php
namespace Intern\SampleData;

use Intern\SampleData\RealData\BadgeImport;
use Intern\SampleData\RealData\CompanyDepartmentImport;
use Intern\SampleData\RealData\CompanyImport;
use Intern\SampleData\RealData\CompanyTypeImport;
use Intern\SampleData\RealData\GeoImport;
use Intern\SampleData\RealData\JobImport;
use Intern\SampleData\RealData\JobTagImport;
use Intern\SampleData\RealData\ProvinceImport;
use Intern\SampleData\RealData\ResumeImport;
use Intern\SampleData\RealData\SkillImport;
use Intern\SampleData\RealData\UniversityImport;
use Intern\SampleData\RealData\UniversityTypeImport;
use Intern\SampleData\RealData\UserImport;

class Importer
{
    function __construct()
    {
        global $faker;
        $faker = \Faker\Factory::create();

        iLog('**** Purging All Data! ****', true);
        \R::nuke(); //purge all tables

        //order by priority
        new GeoImport();
        new ProvinceImport();
        new CompanyTypeImport();
        new CompanyImport();
        new CompanyDepartmentImport(); //need company & user
        new UniversityTypeImport();
        new UniversityImport();
        new ResumeImport(); //need user, company, university
        new BadgeImport(); //need user
        new SkillImport();
        new UserImport(); //need skill
        new JobTagImport();
        new JobImport();

        iLog('**** Success Import! ****', true);
    }
}
