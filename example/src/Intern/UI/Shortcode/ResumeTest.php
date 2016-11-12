<?php
namespace Intern\UI\Shortcode;

use Intern\Model\Company;
use Intern\Model\CompanyDepartment;
use Intern\Model\Skill;
use Intern\Model\SkillType;
use Intern\Provider\FormProvider;

class ResumeTest extends FormProvider
{

    public static function construct()
    {

        iLog('shot');

        \R::debug(true);

        $resume = new \Intern\Model\Resume();
        $company = new Company();
        $companyDepartment = new CompanyDepartment();
        $skill = new Skill();
        $skillType = new SkillType();

        self::jQuery();
//        self::Form_Begin();



        self::Render_Select(
            [
                'model' => $skillType,
                'column' => 'name',
                'label' => 'ทักษะ',
                'multiple' => true,
                'relation_model' => 'sharedSkill',
                'relation_column' => 'name',
            ]
        );


//        $category = \R::load('company', 1);
//        $shops= $category->withCondition('companytype_id = ?',[1]);
//        var_dump(json_encode($shops));

//        var_dump('-------'.json_encode($skill));
//
        //----------------------------

        ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">สร้าง Resume</h3>
                        </div>

                        <div class="panel-body">
                            <form role="form">
                                <div class="form-group required">
                                    <label for="title" >ชื่อ Resume</label>
                                    <input type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="ชื่อหัวเรื่อง">
                                    <small class="form-text text-muted">เช่น: ขอฝึกงานบริษัท ...</small>
                                </div>
                                <?php
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
                                    <label for="rangedate">ระยะเวลาขอฝึกงาน:</label>
                                    <input class="form-control" type="text" placeholder="คลิกเพื่อเปิดปฏิทิน" id="rangedate">
                                </div>

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
                <div class="col-md-7">
                    <div class="panel panel-primary">
                        <div class="panel-heading clearfix">
                            <h3 class="panel-title pull-left">ข้อความเพิ่มเติม</h3>
                            <div class="btn-group btn-group-xs pull-right"> <a href="#" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></a>
                                <a href="#" class="btn btn-danger"><span class="glyphicon glyphicon-minus"></span></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="description">ข้อความจะถูกแนบไปพร้อมกับ Resume</label>
                                <textarea id="description" class="form-control" rows="6"></textarea>
                            </div>
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

                $('#rangedate').DatePicker({
                    type: 'rangedate',
                    locale: 'th',
                    modalMode: true,
                    startDate: moment().subtract(1, 'week'),
                    endDate: moment()
                });
            });

        </script>
<?php

    }
}
