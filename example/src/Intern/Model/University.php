<?php
namespace Intern\Model;
use Intern\ConcatTrait\NameLangTrait;
use Intern\Controller\RedBeanController;

/**
 * @property int id
 * @property string name_th
 * @property string name_eng
 * @property string short_name
 * @property string short_name_eng
 * @property string website
 * @property int province_id
 */
class University extends RedBeanController
{
    use NameLangTrait;

    protected $type;

    function __construct($id = 0)
    {
        parent::__construct($id);
    }

    /**
     * @return UniversityType
     */
    public function getType()
    {
        return new UniversityType($this->dataModel->universitytype_id);
    }

    /**
     * @param int UniversityType $type
     */
    public function setType($type)
    {
        $this->dataModel->universitytype_id = $type;
    }

    /**
     * @return string
     */
    public function getShortName()
    {
        return $this->dataModel->short_name;
    }

    /**
     * @param string $short_name
     */
    public function setShortName($short_name)
    {
        $this->dataModel->short_name = $short_name;
    }

    /**
     * @return string
     */
    public function getShortNameEng()
    {
        return $this->dataModel->short_name_eng;
    }

    /**
     * @param string $short_name_eng
     */
    public function setShortNameEng($short_name_eng)
    {
        $this->dataModel->short_name_eng = $short_name_eng;
    }

    /**
     * @return string
     */
    public function getWebsite()
    {
        return $this->dataModel->website;
    }

    /**
     * @param string $website
     */
    public function setWebsite($website)
    {
        $this->dataModel->website = $website;
    }

    /**
     * @return int
     */
    public function getProvinceId()
    {
        return $this->dataModel->province_id;
    }

    /**
     * @param int Province $province_id
     */
    public function setProvinceId($province_id)
    {
        $this->dataModel->province_id = $province_id;
    }
}
