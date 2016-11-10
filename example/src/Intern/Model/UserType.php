<?php
namespace Intern\Model;
use Intern\ConcatTrait\NameTrait;
use Intern\Controller\RedBeanController;

/**
 * @property int id
 * @property string name
**/
class UserType extends RedBeanController
{
    protected $table = 'wp_users_type';

    use NameTrait;
    function __construct($id = 0)
    {
        parent::__construct($id, true);
    }
}
