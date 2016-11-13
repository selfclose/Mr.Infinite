<?php

namespace Intern\UI\Shortcode;
use Intern\Model\Job;
use Intern\Provider\Render;

use Intern\Model\Company;

class JobList
{
    public static function construct()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 1; //get current page

        $limit = 3; //limit per page

        $job = new Job();
        $job_paginate = $job->paginateAction($page, $limit, 'id', false);
        ?>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>ชื่อบริษัท</th>
                <th>ที่อยู่</th>
            </tr>
            </thead>
            <tbody>
            <?php
            /**
             * @var $item Company
             */
            foreach ($job_paginate as $item) : ?>
                <tr>
                    <th scope="row"><?= $item->id ?></th>
                    <td><?= $item->name ?></td>
                    <td><?= $item->address ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php
        echo $job->paginateButtonAction($page, $limit);

        echo "<p>Result: " . count($job_paginate) . "</p>";
    }
}
