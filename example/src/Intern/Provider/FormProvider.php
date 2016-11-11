<?php
namespace Intern\Provider;

class FormProvider
{
    public static function jQuery()
    {
        ?>
            <script>
                (function($) {
                    $(document).ready(function() {
                        $('select').select2();
                    });
                })(jQuery);
            </script>
        <?php
    }

    public $Button_Submit_class = '';

    public static function Form_Begin($action = ' ', $method = 'get')
    {
        echo "<form method=\"{$method}\" action=\"{$action}\">";
    }

    public static function Form_End()
    {
        echo "</form>";
    }

    public static function Select($loopFor, $printValue, $class = 'form-control')
    {
        echo "<select class=\"{$class}\" name=\"{$loopFor->getTable()}\">";
        foreach ($loopFor->readAllAction() as $key=>$value) {
            echo "<option value='{$value->id}'>{$value[$printValue]}</option>";
        }
        echo "</select>";
    }

    public static function Select_Multiple($loopFor, $printValue, $class = 'form-control')
    {
        echo "<select class=\"{$class}\" name=\"{$loopFor->getTable()}\" multiple=\"multiple\">";
        foreach ($loopFor->readAllAction() as $key=>$value) {
            echo "<option value='{$value->id}'>{$value[$printValue]}</option>";
        }
        echo "</select>";
    }

    public static function Render_Select($parameters)
    {
        $table = $parameters['model'];
        $class = isset($parameters['class'])?:'form-control';
        $multiple = isset($parameters['multiple'])?" multiple=\"multiple\"":"";
        $column = $parameters['column'];
        $label = isset($parameters['label'])?:false;
        $table_optgroup = isset($parameters['model_optgroup'])?:false;
        $column_optgroup = isset($parameters['column_optgroup'])?:false;

        if (isset($parameters['label'])) {
            echo "<label for=\"{$table->getTable()}\">";
            echo $label;
        }

        echo "<select class='{$class}' name='{$table->getTable()}'{$multiple}>";

        foreach ($table->readAllAction() as $key=>$value) {
            echo "<option value=\"{$value->id}\">{$value[$column]}</option>";
        }

        echo "</select>";

        if (isset($label)) {
            echo "</label>";
        }
    }

    public static function Button_Submit($label)
    {
        echo "<input type=\"submit\" value=\"{$label}\" />";
    }
}
