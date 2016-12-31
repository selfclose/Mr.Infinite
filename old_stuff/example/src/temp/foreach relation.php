<?php
echo "<select name='test'>";

/**
 * @var $skType SkillType
 */
foreach ($skillType->findAllAction() as $skType) {

    echo "<optgroup label='{$skType->name}'></optgroup>";

    /**
     * @var $sk Skill
     */
    foreach ($skType->sharedSkill as $sk) {

        echo "<option value='{$sk->id}'>{$sk->name}</option>";
    }
}

echo "</select>";

//$(document).ready(function() {
//    $('.bar').daterangeBar({
//                    'endDate': '13-11-2016',
//                    'barClass': 'progress-bar-striped active',
//                    'bootstrap': true,
//                    'privateColors': false,
//                    'msg': 'of January'
//                });