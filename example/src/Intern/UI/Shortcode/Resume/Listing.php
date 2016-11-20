<?php

namespace Intern\UI\Shortcode\Resume;

use Intern\Config\Table;
use Intern\Model\Education;
use Intern\Model\Job;
use Intern\Model\JobTag;
use Intern\Model\Province;
use Intern\Model\Resume;
use Intern\Model\User;
use Intern\Provider\DateTimeProvider;
use Intern\Provider\Render;

use Intern\Model\Company;

class Listing
{
    public static function construct()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 1; //get current page

        $limit = 8; //limit per page

        $resume = new Resume();
        $user = new User();
        $province = new Province();
        $timeProvider = new DateTimeProvider();

        $resume_paginate = $resume->paginateAction($page, $limit, 'id', false);
//        \R::debug(true);
        ?>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>ชื่อ - สกุล</th>
                <th>ชื่อเรื่อง</th>
                <th>จากมหาวิทยาลัย</th>
                <th>จังหวัด</th>
                <th>อายุ</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = ($page - 1) * $limit;
            /**
             * @var $item Resume
             */
            foreach ($resume_paginate as $item) { $i++;
                $user->readAction($item->wp_users_id);
                ?>
                <tr>
                    <th scope="row"><?=$i?></th>
                    <td><a href="?id=<?=$item->id?>"><?=$user->getDisplayName()?></a></td>
                    <td><a href="?id=<?=$item->id?>"><?=$item->title?></a></td>
                    <td><a href="?id=<?=$item->id?>"><ul>
                <?php
                /**
                 * @var $edu Education
                 */
                echo json_encode($user->getEducations());
                foreach ($user->getEducations() as $edu) {
                    echo "<li>{$edu->name_th}</li>";
                }?></ul></a></td>
                    <td><a href="?id=<?=$item->id?>"><?=$user->getProvince()->getName()?></a></td>
                    <td><a href="?id=<?=$item->id?>"><?=$timeProvider->yearDiff($user->getBirthDate(),  date("Y-m-d H:i:s"))?></a></td>

                </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php
        echo $resume->paginateButtonAction($page, $limit);

        echo "<p>พบงาน: " . $resume->countAction() . " รายการ</p>";
    }
}
