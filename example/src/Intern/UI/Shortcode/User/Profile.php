<?php
namespace Intern\UI\Shortcode\User;

use Intern\Model\Company;
use Intern\Model\CompanyDepartment;
use Intern\Model\Province;
use Intern\Model\Skill;
use Intern\Model\SkillType;
use Intern\Model\User;
use Intern\Provider\FormProvider;
use Intern\Provider\Render;

class Profile
{

    public static function construct()
    {

        \R::debug(false);

        $current_id = isset($_GET['id'])?$_GET['id']:0;
        $user = new User($current_id);
        $company = new Company();
        $province = new Province();
        $companyDepartment = new CompanyDepartment();
        $skill = new Skill();
        $skillType = new SkillType();

        Render::jQuery();
//        self::Form_Begin();


//        $category = \R::load('company', 1);
//        $shops= $category->withCondition('companytype_id = ?',[1]);
//        var_dump(json_encode($shops));

//        var_dump('-------'.json_encode($skill));
//
        //----------------------------

        ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">User Profile</h3>
                        </div>

                        <div class="panel-body">
                            <form role="form">
                                <div class="form-group text-right">
                                    <button class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
                                    <button class="btn btn-default"><i class="fa fa-save"></i> ยกเลิก</button>
                                </div>

                                <?php
                                Render::Input(
                                    [
                                        'id'    => 'email',
                                        'label' => 'Email Address',
                                        'data'  => $user->getEmail(),
                                        'disabled'  => true,
                                        'required'  => true,
                                        'muted' => 'เป็นเมลล์ถาวร ไม่สามาถเปลี่ยนได้',
                                    ]
                                );
                                ?>
                                <div class="form-group required">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" aria-describedby="email"
                                           placeholder="Enter email" value="<?=$user->getEmail()?>" disabled>
                                    <small id="emailHelp" class="form-text text-muted">เป็นเมลล์ถาวร ไม่สามารถเปลี่ยนได้.</small>
                                </div>
                                <div class="form-group required">
                                    <label for="display_name" >ชื่อจริง - สกุล</label>
                                    <input type="text" class="form-control" id="display_name" aria-describedby="emailHelp" placeholder="น้องใหม่ ร้ายบริสุทธิ์"
                                           value="<?=$user->getDisplayName()?>">
                                    <small class="form-text text-muted">ไม่ต้องมีคำนำหน้าชื่อ</small>
                                </div>
                                <div class="form-group">
                                    <img class="img-thumbnail" src="<?=$user->getImageUrl()?>">
                                </div>
                                <?php
                                Render::Input(
                                    [
                                        'id' => 'user',
                                        'label' => 'Username',
                                        'data' => $user->getUsername(),
                                        'disabled' => true,
                                    ]
                                );
                                Render::DateDialog(
                                    [
                                        'id' => 'birth_date',
                                        'label' => 'วันเกิด',
                                        'data' => $user->getBirthDate(),
                                    ]
                                );
                                Render::Textarea(
                                    [
                                        'id' => 'address',
                                        'label' => 'ที่อยู่',
                                        'data' => $user->getAddress(),
                                    ]
                                );
                                Render::Input(
                                    [
                                        'id' => 'zipcode',
                                        'label' => 'รหัสไปรษณีย์',
                                        'data' => $user->getZipcode(),
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
                                                'data' => $user->getFacebook(),
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
                                                'data' => $user->getLine(),
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
                                                'data' => $user->getInstagram(),
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
                                        'data' => $user->getDescription(),
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
                                        'data' => $user->getProvince()->getId(),
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
                                        'data' => $user->getSkills(),
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
                                        'data' => $user->getGender(),
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
                                        'data' => $user->isGotJob(),
                                    ]
                                );

                                Render::Input(
                                    [
                                        'id' => 'tel',
                                        'label' => 'เบอร์โทรศัพท์',
                                        'data' => $user->getTel(),
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
