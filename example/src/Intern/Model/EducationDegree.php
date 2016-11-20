<?php
namespace Intern\Model;

use Intern\ConcatTrait\EnabledTrait;
use Intern\ConcatTrait\NameLangTrait;
use Intern\ConcatTrait\NameTrait;
use Intern\Controller\RedBeanController;

/**
 * @property int id
 * @property string name_th
 * @property string name_en
 */
class EducationDegree extends RedBeanController
{
   use NameLangTrait;

    function __construct($id = 0)
    {
        parent::__construct($id);

        $this->dataModel->honour = 0;
    }
}
