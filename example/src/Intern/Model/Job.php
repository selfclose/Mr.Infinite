<?php
namespace Intern\Model;

use Intern\ConcatTrait\NameTrait;
use Intern\Controller\RedBeanController;

/**
 * Class Job
 * @package Intern\Model
 * @property string name
 * @property int company_id
 * @property int companydepartment_id
 * @property int jobtype_id
 * @property string description
 */
class Job extends RedBeanController
{
    use NameTrait;

    function __construct($id = 0)
    {
        parent::__construct($id);
    }


}
