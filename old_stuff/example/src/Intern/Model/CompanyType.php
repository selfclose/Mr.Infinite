<?php
namespace Intern\Model;
use Intern\Controller\RedBeanController;
use Intern\ConcatTrait\NameLangTrait;
/**
 * Class Company
 * @package Intern\Model
 * @property string id
 * @property string name
 */
class CompanyType extends RedBeanController
{
    use NameLangTrait;
    protected $table = 'companytype';

    function __construct($id = 0)
    {
        parent::__construct($id);
    }


}
