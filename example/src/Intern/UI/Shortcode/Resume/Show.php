<?php
namespace Intern\UI\Shortcode\Resume;

use Intern\Config\Table;
use Intern\Model\Company;
use Intern\Model\CompanyDepartment;
use Intern\Model\Education;
use Intern\Model\Province;
use Intern\Model\Resume;
use Intern\Model\Skill;
use Intern\Model\SkillType;
use Intern\Model\User;
use Intern\Provider\DateTimeProvider;
use Intern\Provider\FormProvider;
use Intern\Provider\Render;

class Show
{

    public static function construct()
    {

//        \R::debug(true);

        $current_id = isset($_GET['id'])?$_GET['id']:0;
        $resume = new Resume($_GET['id']);

        $company = new Company();
        $province = new Province();
        $companyDepartment = new CompanyDepartment();
        $skill = new Skill();
        $skillType = new SkillType();

        Render::jQuery();
        ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Resume</h3>
                        </div>

                        <div class="panel-body">
                            <form role="form">
                                <div class="form-group text-right">
                                    <button class="btn btn-primary"><i class="fa fa-check-square-o"></i> Approve</button>
                                    <button class="btn btn-danger"><i class="fa fa-close"></i> Reject</button>
                                    <button class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>

                                <div class="form-group required">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" aria-describedby="email"
                                           placeholder="Enter email" value="<?=$resume->getUser()->getEmail()?>" disabled>
                                    <small id="emailHelp" class="form-text text-muted">เป็นเมลล์ถาวร ไม่สามารถเปลี่ยนได้.</small>
                                </div>
                                <div class="form-group required">
                                    <label for="display_name" >ชื่อจริง - สกุล</label>
                                    <input type="text" class="form-control" id="display_name" aria-describedby="emailHelp" placeholder="น้องใหม่ ร้ายบริสุทธิ์"
                                           value="<?=$resume->getUser()->getDisplayName()?>">
                                    <small class="form-text text-muted">ไม่ต้องมีคำนำหน้าชื่อ</small>
                                </div>

                                <h2><?=$resume->getTitle()?></h2>
                                <div class="row">
                                    <div class="col-sm-4 text-center">
                                        <div class="form-group">
                                            <img class="img-thumbnail" src="<?=$resume->getUser()->getImageUrl()?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4>ข้อมูลผู้สมัคร</h4>
                                        <p>ชื่อ : <?=$resume->getUser()->getDisplayName()?></p>
                                        <p>อายุ: <?=$resume->getUser()->getAge()?> ปี</p>
                                        <p>จังหวัด: <?=$resume->getUser()->getProvince()->getName()?></p>
                                        <hr/>
                                        <h4>การศึกษา</h4>
                                        <p>สถาบัน: </p>
                                        <ul>
                                        <?php
                                        /**
                                         * @var $education Education
                                         */
                                        foreach($resume->getUser()->getEducations() as $education) {
                                            echo "<li>ระดับการศึกษา: {$education->degree->name_th} - คณะ {$education->major->name_th} - {$education[Table::UNIVERSITY]->name_th} | GPA: {$education->GPA}</li>";
                                        }
                                        ?>
                                            </ul>
                                        <hr/>
                                        <h4>การฝึก:</h4>
                                        <p>เริ่มฝึก: <?=$resume->getStartDate()?></p>
                                        <p>สิ้นสุดการฝึก: <?=$resume->getEndDate()?></p>
                                        <p>รวมระยะเวลา: <?=DateTimeProvider::MonthDiff($resume->getStartDate(), $resume->getEndDate())?> เดือน (<?=DateTimeProvider::DayDiff($resume->getStartDate(), $resume->getEndDate())?> วัน)</p>
                                        <hr/>
                                        <p>Facebook: <a href="<?=$resume->getUser()->getFacebook()?>"><?=$resume->getUser()->getFacebook()?></a></p>
                                    </div>
                                </div>


                                <?php
                                Render::Input(
                                    [
                                        'id' => 'user',
                                        'label' => 'Username',
                                        'data' => $resume->getUser()->getUsername(),
                                    ]
                                );
                                Render::DateDialog(
                                    [
                                        'id' => 'start_date',
                                        'label' => 'วันที่เริ่มฝึก',
                                        'data' => $resume->getStartDate(),
                                    ]
                                );
                                Render::DateDialog(
                                    [
                                        'id' => 'start_date',
                                        'label' => 'วันที่สิ้นสุด',
                                        'data' => $resume->getEndDate(),
                                    ]
                                );
                                ?>
                                <div class='row'>
                                    <div class='col-sm-4'>
                                        <?php
                                        Render::Input(
                                            [
                                                'id' => 'facebook',
                                                'label' => 'Facebook',
                                                'data' => $resume->getUser()->getFacebook(),
                                            ]
                                        );
                                        ?>
                                    </div>
                                    <div class='col-sm-4'>
                                        <?php
                                        Render::Input(
                                            [
                                                'id' => 'line',
                                                'label' => 'Line',
                                                'data' => $resume->getUser()->getLine(),
                                            ]
                                        );
                                        ?>
                                    </div>
                                    <div class='col-sm-4'>
                                        <?php
                                        Render::Input(
                                            [
                                                'id' => 'instagram',
                                                'label' => 'Instagram',
                                                'data' => $resume->getUser()->getInstagram(),
                                            ]
                                        );
                                        ?>
                                    </div>
                                </div>
                                <?php
                                Render::Textarea(
                                    [
                                        'id' => 'description',
                                        'label' => 'อธิบายส่วนตัว',
                                        'class' => 'form-control editor',
                                        'data' => $resume->getUser()->getDescription(),
                                    ]
                                );
                                Render::Select(
                                    [
                                        'model' => $province,
                                        'column' => 'name_th',
                                        'id' => $province->getTable(),
                                        'label' => 'จังหวัด',
                                        'class' => 'form-control',
//                                        'relation_model' => 'sharedSkill',
//                                        'relation_column' => 'name',
                                        'data' => $resume->getUser()->getProvince()->getId(),
                                    ]
                                );
                                Render::Select(
                                    [
                                        'model' => $skillType,
                                        'column' => 'name',
                                        'id' => $skillType->getTable(),
                                        'label' => 'ทักษะ - ความสามารถ',
                                        'multiple' => true,
                                        'class' => 'form-control',
                                        'relation_model' => 'sharedSkill',
                                        'relation_column' => 'name',
                                        'data' => $resume->getUser()->getSkills(),
                                    ]
                                );

                                Render::RadioGroup(
                                    [
                                        'id' => 'gender',
                                        'label' => 'เพศ: ',
                                        'choice' => [
                                            'm' => 'ชาย',
                                            'f' => 'หญิง',
                                            'n' => 'ไม่ระบุ',
                                        ],
                                        'data' => $resume->getUser()->getGender(),
                                    ]
                                );
                                Render::RadioGroup(
                                    [
                                        'id' => 'worked',
                                        'label' => 'การทำงาน',
                                        'choice' => [
                                            '0' => 'ว่างงาน',
                                            '1' => 'มีงานแล้ว',
                                        ],
                                        'data' => $resume->getUser()->isGotJob(),
                                    ]
                                );

                                Render::Input(
                                    [
                                        'id' => 'tel',
                                        'label' => 'เบอร์โทรศัพท์',
                                        'data' => $resume->getUser()->getTel(),
                                    ]
                                );

                                ?>


                                <div class="form-group">
                                    <label for="title">Url ไฟล์แนบ</label>
                                    <input type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="ชื่อหัวเรื่อง">
                                    <small class="form-text text-muted">เช่น: http://portforio.com/mylink/</small>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" />ฉัน ยอมรับ ข้อตกลงของเว็บไซต์</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> ดูตัวอย่าง</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="dtBox"></div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.bar').daterangeBar({
                    'endDate': '13-11-2016',
                    'barClass': 'progress-bar-striped active',
                    'bootstrap': true,
                    'privateColors': false,
                    'msg': 'of January'
                });

                $("#dtBox").DateTimePicker({
                    setButtonContent: 'เลือก...',
                    titleContentDate: 'เลือกวันเกิด',
                    fullMonthNames: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม']
                });

                tinymce.init({
                    selector: 'textarea.editor',
                    height: 500,
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table contextmenu paste code'
                    ],
                    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                    content_css: '//www.tinymce.com/css/codepen.min.css'
                });
            });

        </script>
<?php

    }
}
