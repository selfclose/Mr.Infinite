<?php
namespace Intern\Model;
use Intern\Controller\RedBeanController;
use Intern\ConcatTrait\NameTrait;
/**
 * Class Company
 * @package Intern\Model
 * @property string id
 * @property string name
 */
class CompanyType extends RedBeanController
{
    protected $table = 'companytype';

    function __construct($tableId = 0)
    {
        parent::__construct($tableId);
    }

    use NameTrait;
}
