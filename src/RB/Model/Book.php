<?php
namespace RB\Model;
use RB\Controller\RedBeanController;

/**
 * Class Book
 * @property int id
 * @property string name
 * @property int price
 */
class Book extends RedBeanController
{
    protected $table = 'book';

    function __construct($tableId = 0)
    {
        parent::__construct($tableId);
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
