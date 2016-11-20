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
        $allTags = $jobTag->findAllAction();
        $company = new Company();

        $job_paginate = $job->paginateAction($page, $limit, 'id', false);
        ?>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>รายละเอียด</th>
                <th>ประกาศโดย</th>
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
                    <td>
                        <div class="pull-left">
                            <img class="img-thumbnail" style="max-width: 120px;" src="<?=$company->getImageUrl()?>" />
                        </div>
                        <p><a href="?id=<?=$item->id?>"><?=$item->title?></a></p>
                        <p><a href="?company=<?=$company->getId()?>"><?=$company->getName()?></a></p>

                        <div>
                            <?php
                            /**
                             * @var $tag JobTag
                             */
                            foreach ($item->sharedJobtag as $tag) { ?>
                                <a class="btn btn-default btn-sm" href="?all=<?=$tag->id?>"><?=$tag->name_th?></a>
                            <?php } ?>
                        </div>
                    </td>
                    <td>
                        <a href="#" class="btn btn-warning btn-lg">สมัครงาน</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php
        echo $job->paginateButtonAction($page, $limit);

        echo "<p>พบงาน: " . $job->countAction() . " รายการ</p>";
    }
}
