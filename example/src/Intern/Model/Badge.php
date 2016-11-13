<?php
namespace Intern\Model;

use Intern\ConcatTrait\EnabledTrait;
use Intern\ConcatTrait\NameTrait;
use Intern\Controller\RedBeanController;

/**
 * @property string name
 * @property int company_id
 * @property int companydepartment_id
 * @property int jobtype_id
 * @property string description
 */
class Badge extends RedBeanController
{
    use NameTrait;

    function __construct($id = 0)
    {
        parent::__construct($id);
    }


}
