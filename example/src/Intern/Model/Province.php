<?php
namespace Intern\Model;
use Intern\Controller\RedBeanController;

/**
 * Class Province
 * @package Intern\Model
 * @property int id
 * @property int province_id
 * @property string name
 * @property string name_eng
 * @property Geo geo_id
 */
class Province extends RedBeanController
{
    function __construct($tableId = 0)
    {
        $this->setTableName('province');
        parent::__construct($tableId);
    }

    /**
     * @return int
     */
    public function getProvinceId()
    {
        return $this->dataModel->provinceid;
    }

    /**
     * @param int $province_id
     */
    public function setProvinceId($province_id)
    {
        $this->dataModel->provinceid = $province_id;
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
     * @return string
     */
    public function getNameEng()
    {
        return $this->dataModel->name_eng;
    }

    /**
     * @param string $name_eng
     */
    public function setNameEng($name_eng)
    {
        $this->dataModel->name_eng = $name_eng;
    }

    /**
     * @return Geo
     */
    public function getGeoId()
    {
        return $this->dataModel->geo_id;
    }

    /**
     * @param Geo $geo_id
     */
    public function setGeoId($geo_id)
    {
        $geo = new Geo($geo_id);
        $this->dataModel->geo_id = $geo->dataModel;
//        $this->dataModel->setMeta("buildcommand.unique", [[$this->dataModel->province_id]]);
    }

}
