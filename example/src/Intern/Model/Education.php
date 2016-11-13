<?php
namespace Intern\Model;

use Intern\ConcatTrait\EnabledTrait;
use Intern\ConcatTrait\NameTrait;
use Intern\Controller\RedBeanController;

/**
 * @property string name
 * @property int level
 * @property int school_name
 * @property int university
 * @property string description
 */
class Badge extends RedBeanController
{
    use NameTrait;

    function __construct($id = 0)
    {
        parent::__construct($id);
    }

    /**
     * @return array
     */
    public function getUniversity()
    {
        return array_keys($this->dataModel->sharedUniversity);
    }

    /**
     * @param $universities array University
     */
    public function setUniversity($universities)
    {
        unset($this->dataModel->sharedUniversity);
        if (is_array($universities)) {
            foreach ($universities as $resume) {
                $this->dataModel->sharedUniversity[] = \R::load('university', $resume);
            }
        }
    }

}
