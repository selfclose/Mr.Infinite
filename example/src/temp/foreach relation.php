<?php
echo "<select name='test'>";

/**
 * @var $skType SkillType
 */
foreach ($skillType->readAllAction() as $skType) {

    echo "<optgroup label='{$skType->name}'></optgroup>";

    /**
     * @var $sk Skill
     */
    foreach ($skType->sharedSkill as $sk) {

        echo "<option value='{$sk->id}'>{$sk->name}</option>";
    }
}

echo "</select>";