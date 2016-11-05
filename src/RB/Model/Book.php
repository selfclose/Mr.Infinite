<?php
namespace RB\Model;
use RB\Controller\RedBeanController;

/**
 * Class Book
 * @property int id
 * @property string name
 */
class Book extends RedBeanController
{

    function __construct($id = 0)
    {
        $this->table = 'book';
        parent::__construct($id);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->dataModel->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->dataModel->name = $name;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->dataModel->price;
    }

    /**
     * @param int $price
     */
    public function setPrice($price)
    {
        $this->dataModel->price = $price;
    }
}
