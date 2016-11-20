<?php

namespace Intern\UI\Shortcode\User;

use Intern\Model\Job;
use Intern\Model\JobTag;
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

        $user = new User();
        $user_paginate = $user->paginateAction($page, $limit, 'id', false);
        ?>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>ชื่อ - สกุล</th>
                <th>username</th>
                <th>เพศ</th>
                <th>อายุ</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = ($page - 1) * $limit;
            /**
             * @var $item User
             */
            foreach ($user_paginate as $item) { $i++;
                ?>
                <tr>
                    <th scope="row"><?=$i?></th>
                    <td><a href="?id=<?=$item->id?>"><?=$item->display_name?></a></td>
                    <td><a href="?id=<?=$item->id?>"><?=$item->username?></a></td>
                    <td><a href="?id=<?=$item->id?>"><?=$item->gender?></a></td>
                    <td><a href="?id=<?=$item->id?>"><?=DateTimeProvider::yearDiff($item->birthDate,  date("Y-m-d H:i:s"))?></a></td>

                </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php
        echo $user->paginateButtonAction($page, $limit);

        echo "<p>พบงาน: " . $user->countAction() . " รายการ</p>";
    }
}
