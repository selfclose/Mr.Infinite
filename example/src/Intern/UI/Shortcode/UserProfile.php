<?php
namespace Intern\UI\Shortcode;

use Intern\Model\Company;
use Intern\Model\CompanyDepartment;
use Intern\Model\Skill;
use Intern\Model\SkillType;
use Intern\Model\User;
use Intern\Provider\FormProvider;

class UserProfile extends FormProvider
{

    public static function construct()
    {

        \R::debug(false);

        $current_id = isset($_GET['id'])?$_GET['id']:0;
        $user = new User($current_id);
        $company = new Company();
        $companyDepartment = new CompanyDepartment();
        $skill = new Skill();
        $skillType = new SkillType();

        self::jQuery();
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
                                    <label for="birth_date">วันเกิด</label>
                                    <input class="form-control col-sm-6" type="text" id="birth_date" name="birth_date" data-field="date" value="<?=$user->getBirthDate()?>" readonly>
                                </div>
                                <?php
                                self::Textarea(
                                    [
                                        'id' => 'address',
                                        'label' => 'ที่อยู่',
                                        'data' => $user->getAddress(),
                                    ]
                                );
                                self::Input(
                                    [
                                        'id' => 'zipcode',
                                        'label' => 'รหัสไปรษณีย์',
                                        'data' => $user->getZipcode(),
                                    ]
                                );

                                self::Textarea(
                                    [
                                        'id' => 'description',
                                        'label' => 'อธิบายส่วนตัว',
                                        'data' => $user->getDescription(),
                                    ]
                                );
                                self::Render_Select(
                                    [
                                        'model' => $skillType,
                                        'column' => 'name',
                                        'label' => 'ทักษะ - ความสามารถ',
                                        'multiple' => true,
                                        'class' => 'form-control',
                                        'relation_model' => 'sharedSkill',
                                        'relation_column' => 'name',
                                        'data' => $user->getSkills(),
                                    ]
                                );

                                self::Render_Select(
                                    [
                                        'label' => 'ถึง บริษัท:',
                                        'model' => $company,
                                        'column' => 'company_name',
                                        'class' => 'col-sm-12'
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
            });

        </script>
<?php

    }
}
