<?php
namespace Intern\Model;

use Intern\ConcatTrait\NameLangTrait;
use Intern\Controller\RedBeanController;

class JobType extends RedBeanController
{
    use NameLangTrait;

    function __construct($id = 0)
    {
        parent::__construct($id);
    }
}
