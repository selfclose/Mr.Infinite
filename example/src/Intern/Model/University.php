<?php
namespace Intern\Model;

/**
 * @property int university_id
 * @property string name
 * @property string name_eng
 * @property string short_name
 * @property string short_name_eng
 * @property string website
 * @property int province_id
 */
class University implements UniversityInterface
{
    protected $id;
    protected $university_id;
    protected $name;
    protected $name_eng;
    protected $short_name;
    protected $short_name_eng;
    protected $website;
    protected $province_id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUniversityId()
    {
        return $this->university_id;
    }

    /**
     * @param int $university_id
     */
    public function setUniversityId($university_id)
    {
        $this->university_id = $university_id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = wp_strip_all_tags($name);
    }

    /**
     * @return mixed
     */
    public function getNameEng()
    {
        return $this->name_eng;
    }

    /**
     * @param mixed $name_eng
     */
    public function setNameEng($name_eng)
    {
        $this->name_eng = wp_strip_all_tags($name_eng);
    }

    /**
     * @return mixed
     */
    public function getShortName()
    {
        return $this->short_name;
    }

    /**
     * @param mixed $short_name
     */
    public function setShortName($short_name)
    {
        $this->short_name = $short_name;
    }

    /**
     * @return mixed
     */
    public function getShortNameEng()
    {
        return $this->short_name_eng;
    }

    /**
     * @param mixed $short_name_eng
     */
    public function setShortNameEng($short_name_eng)
    {
        $this->short_name_eng = $short_name_eng;
    }

    /**
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param string $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * @return int
     */
    public function getProvinceId()
    {
        return $this->province_id;
    }

    /**
     * @param int $province_id
     */
    public function setProvinceId($province_id)
    {
        $this->province_id = $province_id;
    }
}
