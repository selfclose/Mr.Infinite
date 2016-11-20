<?php
namespace Intern\Provider;

class Render
{
    static function jQuery()
    {
        ?>
            <script>
                (function($) {
                    $(document).ready(function() {
                        $('select').select2({width: '100%' });
                    });
                })(jQuery);
            </script>
        <?php
    }

    public $Button_Submit_class = '';

    static function Form_Begin($action = ' ', $method = 'get')
    {
        echo "<form method=\"{$method}\" action=\"{$action}\">";
    }

    static function Form_End()
    {
        echo "</form>";
    }

    static function Select($parameters)
    {
        $table = $parameters['model'];
        $id = $parameters['id']?$parameters['id']:'';
        $classLabel = isset($parameters['class_label']) ? $parameters['class_label'] : '';
        $classSelect = isset($parameters['class']) ? $parameters['class'] : 'form-control';
        $multiple = isset($parameters['multiple']) ? " multiple=\"multiple\"" : "";
        $column = $parameters['column'];
        $label = isset($parameters['label']) ? $parameters['label'] : false;

        $choice = $parameters['choice'];
        //for group-menu if you pass
        $relation_model = isset($parameters['relation_model']) ? $parameters['relation_model'] : false;
        $relation_column = isset($parameters['relation_column']) ? $parameters['relation_model'] : false;
        $data = isset($parameters['data'])?$parameters['data']:false;

        if (isset($parameters['label'])) {
            echo "<label class='{$classLabel}' for=\"{$id}\">{$label}</label>";
        }
        echo "<div class=\"form-group\">";
        echo "<select id='{$id}' class='{$classSelect}' name='{$id}'{$multiple}>";

        if (isset($choice)) { //if custom choice

            foreach ($choice as $key => $value) {
                echo "<option value=\"{$key}\">{$value}</option>";
            }
        }
        else {

            //group or not
            if (!$relation_model && !$relation_column) {
                foreach ($table->findAllAction() as $key => $value) {
                    echo "<option value=\"{$value->id}\">{$value[$column]}</option>";
                }
            }
            else {
                foreach ($table->findAllAction() as $key => $value) {
                    echo "<optgroup label='{$value[$column]}'></optgroup>";

                    foreach ($value[$relation_model] as $sk) {
                        echo "<option value='{$sk->id}'>{$sk['name']}</option>";
                    }
                }
            }
        }

        echo "</select>";
        echo "</div>";

        if ($data) {
            ?>
            <script>
                $(document).ready(function () {
                    $('#<?=$id?>').val(<?=is_array($data)?self::ArrayToStringKey($data):$data?>).trigger('change');
                });
            </script>
            <?php
        }
    }

    static function Button_Submit($label)
    {
        echo "<input type=\"submit\" value=\"{$label}\" />";
    }

    static function Input_Password($parameters)
    {
        $class = $parameters['class']?$parameters['class']:'form-control';
        $class_label = $parameters['class_label']?:'';
        $label = $parameters['label'];
        $id = $parameters['name']?$parameters['name']:false;
        $required = $parameters['required']?' required':'';
        $placeholder = $parameters['placeholder']?:'';

        echo "<div class=\"form-group{$required}\">";
        echo "<label for=\"{$id}\" class=\"{$class_label}\">{$label}</label>";
        echo "<input type=\"password\" class=\"{$class}\" id=\"{$id}\" placeholder=\"{$placeholder}\">";
        echo "</div>";
    }

    static function Input($parameters)
    {
        $class = isset($parameters['class'])?$parameters['class']:'form-control';
        $class_label = isset($parameters['class_label'])?$parameters['class_label']:'';
        $label = $parameters['label'];
        $id = isset($parameters['id'])?$parameters['id']:false;
        $required = isset($parameters['required'])?' required':'';
        $placeholder = isset($parameters['placeholder'])?$parameters['placeholder']:'';
        $type = isset($parameters['type'])?$parameters['type']:'text';
        $disabled = $parameters['disabled'] == true ?'disabled="true"': '';
//        $muted = isset($parameters['muted'])?
        $data = isset($parameters['data'])?$parameters['data']:'';

        echo "<div class=\"form-group{$required}\">";
        echo "<label for=\"{$id}\" class=\"{$class_label}\">{$label}</label>";
        echo "<input type=\"{$type}\" class=\"{$class}\" id=\"{$id}\" placeholder=\"{$placeholder}\" {$disabled} value=\"{$data}\">";
        echo "</div>";
    }

    static function Textarea($parameters)
    {
        $class = isset($parameters['class'])?$parameters['class']:'form-control';
        $class_label = $parameters['class_label']?:'';
        $label = $parameters['label'];
        $id = isset($parameters['id'])?$parameters['id']:'';
        $data = $parameters['data'];
        $row = isset($parameters['row'])?$parameters['row']:6;

        echo "<div class=\"form-group\">";
        echo "<label class=\"{$class_label}\" for=\"{$id}\">{$label}</label>";
        echo "<textarea id=\"{$id}\" name=\"{$id}\" class=\"{$class}\" rows=\"{$row}\">{$data}</textarea>";
        echo "</div>";
    }

    static function RadioGroup($parameters)
    {
        $class = isset($parameters['class'])?$parameters['class']:'radio-inline';
        $class_label = $parameters['class_label']?:'';
        $label = $parameters['label'];
        $id = isset($parameters['id'])?$parameters['id']:'';
        $choice = $parameters['choice'];
        $data = $parameters['data'];

        echo "<div class=\"form-group\">";
        echo "<label class=\"{$class_label}\" for=\"{$id}\">{$label}</label>";
        foreach ($choice as $key => $value) {
            echo "<label class=\"{$class}\"><input type=\"radio\" name=\"{$id}\" id=\"{$id}\"";
            if (isset($data) && $data==$key) {
                echo " checked=\"checked\"";
            }
            echo " value=\"{$key}\"> {$value}</label>";
        }
        echo "</div>";
    }

    static function DateDialog($parameters)
    {
        $class = isset($parameters['class'])?$parameters['class']:'form-control';
        $class_label = $parameters['class_label']?:'';
        $label = $parameters['label'];
        $id = isset($parameters['id'])?$parameters['id']:'';
        $data = $parameters['data'];

        echo "<div class=\"form-group\">";
        echo "<label class=\"{$class_label}\" for=\"{$id}\">{$label}</label>";
        echo "<input class=\"{$class}\" name=\"{$id}\" id=\"{$id}\" type=\"text\" data-field=\"date\" value=\"{$data}\" readonly>";
        echo "</div>";
    }

    //-------- ETC --------
    static function ArrayToStringKey($array, $key = 'id') {
        $i = 0;
        $concat = "[";
        foreach ($array as $item) {
            if ($i==0) {
                $concat .= "\"" . $item[$key] . "\"";
                $i++;
            }
            else
                $concat.= ",\"".$item[$key]."\"";
        }
        $concat.="]";
        return $concat;
        //["4", "3"]
    }
}
