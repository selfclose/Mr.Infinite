<?php
namespace Intern\UI\Shortcode\Job;

use Intern\Model\Company;
use Intern\Model\CompanyDepartment;
use Intern\Model\Job;
use Intern\Model\JobTag;
use Intern\Model\Skill;
use Intern\Model\SkillType;
use Intern\Provider\Render;

class Show
{

    public static function construct()
    {
        $current_id = $_GET['id'];

        $job = new Job($current_id);
        $job_tag = new JobTag();
        $company = new Company($job->getCompany());
        $company_department = new CompanyDepartment($job->getDepartmentId());

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
                            <form role="form">
                                <?php
                                Render::Input(
                                    [
                                        'id' => 'title',
                                        'data' => $job->getTitle(),
                                    ]
                                );
                                Render::Input(
                                    [
                                        'id' => 'company',
                                        'label' => 'โดยบริษัท',
                                        'data' => $company->getName(),
                                    ]
                                );
                                Render::Input(
                                    [
                                        'id' => 'department',
                                        'label' => 'แผนก',
                                        'data' => $company_department->getName(),
                                    ]
                                );
                                Render::Select(
                                    [
                                        'id' => 'tag',
                                        'label' => 'รูปแบบงาน:',
                                        'model' => $job_tag,
                                        'column' => 'name_th',
                                        'multiple' => true,
                                        'class' => 'col-sm-12',
                                        'data' => $job->getTag(),
                                    ]
                                );

                                echo '<div class="row"><div class="col-sm-6">';
                                Render::DateDialog(
                                    [
                                        'id' => 'start_date',
                                        'label' => 'เปิดรับสมัคร',
                                        'data' => $job->getStartDate(),
                                    ]
                                );
                                echo '</div><div class="col-sm-6">';
                                Render::DateDialog(
                                    [
                                        'id' => 'end_date',
                                        'label' => 'สิ้นสุดการรับสมัคร',
                                        'data' => $job->getEndDate(),
                                    ]
                                );
                                echo '</div></div>';
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
                                    'data' => $job->getDescription(),
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
