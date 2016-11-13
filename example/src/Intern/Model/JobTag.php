<?php
namespace Intern\Model;

use Intern\ConcatTrait\NameLangTrait;
use Intern\Controller\RedBeanController;

/**
 * @property int id
 * @property string name_th
 * @property string name_en
 */
class JobTag extends RedBeanController
{
    use NameLangTrait;

    function __construct($id = 0)
    {
        parent::__construct($id);
    }
}
