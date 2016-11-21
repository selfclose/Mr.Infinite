<?php
namespace Intern\SampleData\RealData;

use Intern\Config\Table;
use Intern\Model\Company;
use Intern\Model\Education;
use Intern\Model\Resume;
use Intern\Model\University;
use Intern\Model\User;

class EducationImport
{

    function __construct($loop = 10)
    {
        iLog('--- Importing Education ---', true);

        $university = new University();
        $allUniversity = $university->countAction();

        $allDegree = \R::count(Table::DEGREE);
        $allMajor = \R::count(Table::MAJOR);

        global $faker;

        for ($i=1;$i<$loop;$i++) {
            $data = new Education();
//            $data->setDegree($faker->randomElement([Education::DEGREE_Bachelor, Education::DEGREE_Diploma, Education::DEGREE_Doctoral, Education::DEGREE_Masters]));
            $data->setDegree(rand(1, $allDegree));
            $data->setMajors(rand(1, $allMajor));
            $data->setUniversity(rand(1, $allUniversity));
//            $data->setUser(rand(1, $allUser));
            $data->setDescription($faker->sentence(6));
            $data->setGPA($faker->randomFloat(null, 1.2, 4));
            $data->setStartYear($faker->dateTimeBetween('-3 years', '-2 years'));
            $data->setEndYear($faker->dateTimeBetween('-1 years', 'now'));
            $data->setHonour(rand(0, 2));

            $data->insertAction();
            iLog('* Inserted Education: '.$i);
        }
    }
}
