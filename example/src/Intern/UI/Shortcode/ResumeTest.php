<?php
namespace Intern\UI\Shortcode;

use Intern\Model\Company;
use Intern\Model\CompanyType;
use Intern\Model\Skill;
use Intern\Model\SkillType;
use Intern\Provider\FormProvider;

class ResumeTest extends FormProvider
{

    public static function construct()
    {
        echo "<link rel='stylesheet' type='text/css' href='//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css'>";
        echo "<script src='https://code.jquery.com/jquery-3.1.1.min.js'>";
        echo "<script src='//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js'>";

        iLog('shot');

        \R::debug(false);


        $resume = new \Intern\Model\Resume();
        $company = new Company();
        $skill = new Skill();
        $skillType = new SkillType();

        self::jQuery();
        self::Form_Begin();

        self::Render_Select(
            [
                'model' => $company,
                'column' => 'company_name',
                'label' => 'บริษัท',
            ]
        );

        self::Render_Select(
            [
                'model' => $skill,
                'column' => 'name_th_th',
                'label' => 'บริษัท',
                'multiple' => true,
//                'model_optgroup' => $skillType,
//                'column_optgroup' => 'name_th_th',
            ]
        );

//        $category = \R::load('company', 1);
//        $shops= $category->withCondition('companytype_id = ?',[1]);
//        var_dump(json_encode($shops));

        $skillType->readAction(1);
        $s = $skillType->getSkills();
//        var_dump(json_encode($s));
//
        //----------------------------

        echo "<select name='test'>";

        /**
         * @var $skType SkillType
         */
        foreach ($skillType->readAllAction() as $skType) {

            echo "<optgroup label='{$skType->name}'></optgroup>";

            /**
             * @var $sk Skill
             */
            foreach ($skillType->getSkills() as $sk) {
                echo "<option value='{$sk->id}'>{$sk->name}</option>";
            }
        }

        echo "</select>";

        $comp = new Company();
        $compType = new CompanyType();
        $comp->readAction(1);
        var_dump($comp);

//        self::Select($resume, 'title');
//        self::Select_Multiple($skill, 'name_th_th');

        self::Button_Submit('Save');
        self::Form_End();
        ?>

<?php

    }
}
