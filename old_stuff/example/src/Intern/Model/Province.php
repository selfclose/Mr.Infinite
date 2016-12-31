<?php
namespace Intern\Model;
use Intern\ConcatTrait\NameLangTrait;
use Intern\Controller\RedBeanController;

/**
 * Class Province
 * @package Intern\Model
 * @property int id
 * @property int province_id
 * @property string name
 * @property string name_eng
 * @property Geo geo id here
 */
class Province extends RedBeanController
{
    use NameLangTrait;

    function __construct($tableId = 0)
    {
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
        $this->dataModel->geo_id = $geo_id;
//        $this->dataModel->setMeta("buildcommand.unique", [[$this->dataModel->province_id]]);
    }

}
