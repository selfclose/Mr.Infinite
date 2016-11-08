<?php

class INTERN_FAKE_DATA
{
    private $faker;

    function __construct($purgeDataFirst = true)
    {
        $this->faker = Faker\Factory::create();
//
//        if ($purgeDataFirst) {
//            global $wpdb;
//            $wpdb->query(sprintf("IF OBJECT_ID('%s', 'U') IS NOT NULL
//  DROP TABLE %s", INTERN_TABLE::JOB_TYPE, INTERN_TABLE::JOB_TYPE));
//        }
    }

    /**
     * @param int $records
     */
    public function fake_job_type($records = 1) {
        $job = new MODEL_JobType();

        for ($i=0;$i<$records;$i++) {
            $job->setName($this->faker->firstName);
            $job->setDescription($this->faker->sentence(10));
            $job->insert();
        }

    }

}

