<?php

namespace Intern\UI\Shortcode\Job;
use Intern\Model\Job;
use Intern\Model\JobTag;
use Intern\Provider\Render;

use Intern\Model\Company;

class Listing
{
    public static function construct()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 1; //get current page

        $limit = 8; //limit per page

        $job = new Job();
        $jobTag = new JobTag();
        $allTags = $jobTag->readAllAction();
        $company = new Company();

        $job_paginate = $job->paginateAction($page, $limit, 'id', false);
        ?>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>ชื่อบริษัท</th>
                <th>ประกาศโดย</th>
                <th>ประเภท</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = ($page - 1) * $limit;
            /**
             * @var $item Job
             */
            foreach ($job_paginate as $item) { $i++;
                /**
                 * @var $comp Company
                 */
                $company->readAction($item->company_id);
                ?>
                <tr>
                    <th scope="row"><?=$i?></th>
                    <td><a href="#<?=$item->id?>"><?=$item->title?></a></td>
                    <td><a href="#<?=$company->getId()?>"><?=$company->getName()?></a></td>
                    <td>
                        <?php

                        /**
                         * @var $tag JobTag
                         */
                        foreach ($item->sharedJobtag as $tag) { ?>
                <a class="btn btn-primary" href="#<?=$tag->id?>"><?php print_r($tag->name_th)?></a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php
        echo $job->paginateButtonAction($page, $limit);

        echo "<p>Result: " . count($job_paginate) . "</p>";
    }
}
