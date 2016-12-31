<?php
namespace Intern\UI\Shortcode;

use Intern\Model\Company;
use Intern\Model\Skill;
use Intern\Model\SkillType;
use Intern\Provider\FormProvider;

add_shortcode('intern_resume', ['Intern\UI\Shortcode\Resume', 'construct']);

class Resume extends FormProvider
{

    public static function construct()
    {
        wp_enqueue_style('css-sweetalert');
        wp_enqueue_script('js-sweetalert');
        wp_enqueue_style('pnotify');
        wp_enqueue_script('pnotify');
        wp_enqueue_style('select2');
        wp_enqueue_script('select2');

        \R::debug(false);
        ob_start();

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


        \R::debug(true);
        $category = \R::load('company', 1);
        $shops= $category->withCondition('companytype_id = ?',[1]);
        var_dump(json_encode($shops));

        $skillType->readAction(2);
        $s = $skillType->getSkills();
//        var_dump(json_encode($s));
//
        //----------------------------

        var_dump($skillType->dataModel->sharedSkill);
        echo "<select name='test'>";

        /**
         * @var $skType SkillType
         */
        foreach ($skillType->findAllAction() as $skType) {

            echo "<optgroup label='{$skType->name}'></optgroup>";

            /**
             * @var $sk Skill
             */
            foreach ($skillType->getSkills() as $sk) {
                echo "<option value='{$sk->id}'>{$sk->name}</option>";
            }
        }

        echo "</select>";

        self::Select($resume, 'title');
        self::Select_Multiple($skill, 'name_th_th');

        self::Button_Submit('Save');
        self::Form_End();
        ?>

<?php
        return ob_get_clean();
    }
}
