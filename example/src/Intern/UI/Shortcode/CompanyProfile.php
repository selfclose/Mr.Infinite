<?php

namespace Intern\UI\Shortcode;
use Intern\Provider\Render;

use Intern\Model\Company;

class CompanyProfile
{
    public static function construct()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 1; //get current page

        $limit = 3; //limit per page

        $company = new Company();
        $company_paginate = $company->paginateAction($page, $limit, 'id', false);
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
            foreach ($company_paginate as $item) : ?>
                <tr>
                    <th scope="row"><?= $item->id ?></th>
                    <td><?= $item->name ?></td>
                    <td><?= $item->address ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php
        echo $company->paginateButtonAction($page, $limit);

        echo "<p>Result: " . count($company_paginate) . "</p>";
    }
}
