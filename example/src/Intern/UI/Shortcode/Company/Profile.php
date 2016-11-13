<?php
namespace Intern\UI\Shortcode\Company;

use Intern\Model\Company;
use Intern\Model\CompanyDepartment;
use Intern\Model\CompanyType;
use Intern\Model\Job;
use Intern\Model\JobTag;
use Intern\Model\Province;
use Intern\Provider\Render;

class Profile
{

    public static function construct()
    {
        $current_id = $_GET['company'];

        $company = new Company($current_id);
        $company_type = new CompanyType();

        $province = new Province();

        $company_department = new CompanyDepartment();

        Render::jQuery();

        ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">รายละเอียดงาน</h3>
                        </div>

                        <div class="panel-body">
                            <div>
                                <h2><?=$company->getName()?></h2>
                                <p><img style="max-width: 80%;" src="<?=$company->getImageUrl()?>"></p>
                                <p>Founder : <?=$company->getFounder()?></p>
                                <p>StartDate : <?=$company->getStartDate()?></p>
                                <p>ZipCode : <?=$company->getZipcode()?></p>
                                <p>google coordinate : <?=$company->getGoogleMap()?></p>
                                <p>Wallet : <?=$company->getWallet()?></p>
                                <p>End Package : <?=$company->getEndPackageDate()?></p>
                                <p>Click : <?=$company->getClicked()?></p>
                                <p>Rating : <?=$company->getRating()?></p>
                            </div>

<!--                                'open_date' => [], //later-->
<!--                                'close_date' => [], //later-->

                            <form role="form">
                                <?php
                                Render::Input(
                                    [
                                        'id' => 'company',
                                        'label' => 'ประเภท',
                                        'data' => $company->getAccountType(),
                                    ]
                                );
                                Render::Input(
                                    [
                                        'id' => 'company',
                                        'label' => 'ชื่อบริษัท',
                                        'data' => $company->getName(),
                                    ]
                                );
                                Render::Select(
                                    [
                                        'id' => 'company_type',
                                        'label' => 'ประเภทบริษัท',
                                        'model' => $company_type,
                                        'column' => 'name_th',
                                        'data' => $company->getType(),

                                    ]
                                );
                                Render::Select(
                                    [
                                        'id' => 'province_id',
                                        'label' => 'จังหวัด',
                                        'model' => $province,
                                        'column' => 'name_th',
                                        'data' => $company->getProvinceId(),

                                    ]
                                );
                                Render::Input(
                                    [
                                        'id' => 'tel',
                                        'label' => 'เบอร์โทรติดต่อ',
                                        'data' => $company->getTel(),
                                    ]
                                );
                                Render::Input(
                                    [
                                        'id' => 'fax',
                                        'label' => 'เบอร์โทรติดต่อ',
                                        'data' => $company->getFax(),
                                    ]
                                );
                                Render::Input(
                                    [
                                        'id' => 'address',
                                        'label' => 'ที่อยู่',
                                        'data' => $company->getAddress(),
                                    ]
                                );
                                ?>

                                <div class="form-group">
                                    <label for="attach_url">Url ไฟล์แนบ</label>
                                    <input type="text" class="form-control" id="attach_url" name="attach_url" aria-describedby="attach_url" placeholder="ชื่อหัวเรื่อง">
                                    <small class="form-text text-muted">เช่น: http://portforio.com/mylink/</small>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" />ฉันยอมรับ <a href="#">ข้อตกลง</a>ของเว็บไซต์</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> ดูตัวอย่าง Resume</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="panel panel-primary">
                        <div class="panel-heading clearfix">
                            <h3 class="panel-title pull-left">รายละเอียดการรับสมัคร</h3>
                            <div class="btn-group btn-group-xs pull-right"> <a href="#" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></a>
                                <a href="#" class="btn btn-danger"><span class="glyphicon glyphicon-minus"></span></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            Render::Textarea(
                                [
                                    'id' => 'description',
                                    'label' => 'รายละเอียด และความต้องการ',
                                    'data' => $company->getDescription(),
                                ]
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bar"></div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.bar').daterangeBar({
                    'endDate': '13-11-2016',
                    'barClass': 'progress-bar-striped active',
                    'bootstrap': true,
                    'privateColors': false,
                    'msg': 'of January'
                });

                $("body").append("<div id=\"dtBox\"></div>");
                $("#dtBox").DateTimePicker({
                    setButtonContent: 'เลือก...',
                    titleContentDate: 'วันฝึกงาน',
                    fullMonthNames: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม']

                });
            });

        </script>
        <?php

    }
}
