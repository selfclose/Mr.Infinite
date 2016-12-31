<?php
namespace Intern\Model;
use Intern\ConcatTrait\NameLangTrait;
use Intern\Controller\RedBeanController;

/**
 * @property int id
 * @property string name
**/
class UserType extends RedBeanController
{
    protected $table = 'wp_users_type';

    use NameLangTrait;
    function __construct($id = 0)
    {
        parent::__construct($id, true);
    }
}
