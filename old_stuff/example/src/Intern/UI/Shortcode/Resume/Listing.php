<?php

namespace Intern\UI\Shortcode\Resume;

use Intern\Config\Table;
use Intern\Model\Education;
use Intern\Model\Job;
use Intern\Model\JobTag;
use Intern\Model\Province;
use Intern\Model\Resume;
use Intern\Model\University;
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
        $university = new University();
        $user = new User();
        $company = new Company();
        $province = new Province();
        $timeProvider = new DateTimeProvider();

        $resume_paginate = $resume->paginateAction($page, $limit, 'id', false);

//        \R::debug(true);
        ?>
        <style>
            .status-approve {
                color: limegreen;
            }
            .status-pending {
                color: yellow;
            }
            .status-reject {
                color: darkred;
            }
        </style>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>ชื่อ - สกุล</th>
                <th>ชื่อเรื่อง</th>
                <th>จากมหาวิทยาลัย</th>
                <th>จังหวัด</th>
                <th>อายุ</th>
                <th>สมัครไปยังบริษัท</th>
                <th>Action</th>
                <th>status</th>
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
                    <td><a href="user.php?id=<?=$user->getId()?>"><?=$user->getDisplayName()?></a></td>
                    <td><a href="?id=<?=$item->id?>"><?=$item->title?></a></td>
                    <td><ul>
                <?php
                /**
                 * @var $edu University
                 */
                foreach ($user->getEducations() as $edu) {
                    echo "<li><a href=\"?id={$edu->id}\">{$edu[Table::UNIVERSITY]->name_th}</a></li>";
                }?></ul></td>
                    <td><a href="?id=<?=$user->getProvince()->getId()?>"><?=$user->getProvince()->getName()?></a></td>
                    <td><a href="?id=<?=$item->id?>"><?=$user->getAge()?></a></td>
                    <td><a href="?id=<?=$item->company_id?>"><?php
                            $company->readAction($item->company_id);
                            echo $company->getName();
                            ?></a></td>

                    <td>
                        <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        <a href="?id=<?=$item->id?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                    </td>
                    <td class="text-center">
                        <i class="fa fa-circle status-<?=$item->status?>"></i><br/>
                        <?=$item->status?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php
        echo $resume->paginateButtonAction($page, $limit);

        echo "<p>พบงาน: " . $resume->countAction() . " รายการ</p>";
    }
}
