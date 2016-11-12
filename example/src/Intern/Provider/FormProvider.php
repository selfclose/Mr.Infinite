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
        $class = isset($parameters['class'])?$parameters['class']:'form-control';
        $multiple = isset($parameters['multiple'])?" multiple=\"multiple\"":"";
        $column = $parameters['column'];
        $label = isset($parameters['label'])?$parameters['label']:false;

        //for group-menu if you pass
        $relation_model = isset($parameters['relation_model'])?$parameters['relation_model']:false;
        $relation_column = isset($parameters['relation_column'])?$parameters['relation_model']:false;
        
        if (isset($parameters['label'])) {
            echo "<label for=\"{$table->getTable()}\">";
            echo $label;
        }

        echo "<select class='{$class}' name='{$table->getTable()}'{$multiple}>";

        //group or not
        if (!$relation_model && !$relation_column) {
            foreach ($table->readAllAction() as $key => $value) {
                echo "<option value=\"{$value->id}\">{$value[$column]}</option>";
            }
        }
        else {
            foreach ($table->readAllAction() as $key => $value) {
                echo "<optgroup label='{$value[$column]}'></optgroup>";

                foreach ($value[$relation_model] as $sk) {
                    echo "<option value='{$sk->id}'>{$sk['name']}</option>";
                }
            }
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
