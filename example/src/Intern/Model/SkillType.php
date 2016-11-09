<?php
namespace Intern\Model;
use Intern\ConcatTrait\NameTrait;
use Intern\Controller\RedBeanController;

/**
 * Class SkillType
 * @package Intern\Model
 * @property int id
 * @property string name
 */
class SkillType extends RedBeanController
{
    use NameTrait;

    function __construct($id = 0)
    {
        parent::__construct($id);
    }
}
