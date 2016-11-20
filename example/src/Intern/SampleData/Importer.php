<?php
namespace Intern\SampleData;

use Intern\SampleData\RealData\BadgeImport;
use Intern\SampleData\RealData\CompanyDepartmentImport;
use Intern\SampleData\RealData\CompanyImport;
use Intern\SampleData\RealData\CompanyTypeImport;
use Intern\SampleData\RealData\EducationDegreeImport;
use Intern\SampleData\RealData\EducationImport;
use Intern\SampleData\RealData\EducationMajorImport;
use Intern\SampleData\RealData\GeoImport;
use Intern\SampleData\RealData\JobImport;
use Intern\SampleData\RealData\JobTagImport;
use Intern\SampleData\RealData\MajorImport;
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
        new SkillImport();
        new EducationDegreeImport();
        new EducationMajorImport();
        new EducationImport(); //need university, Major, degree
        new ResumeImport(); //need user, company, university
        new UserImport(); //need skill, resume, education
        new BadgeImport(); //need user

        new JobTagImport();
        new JobImport();

        iLog('**** Success Import! ****', true);
    }
}
