<?php
namespace Intern\Model;
use Intern\ConcatTrait\ImageTrait;
use Intern\ConcatTrait\NameTrait;
use Intern\Controller\RedBeanController;

/**
 * @property string id
 * @property string account_type
 * @property string name
 * @property string logo Url
 * @property CompanyType type
 * @property string founder
 * @property string description
 * @property \DateTime start_date
 * @property array tel
 * @property array fax
 * @property array open_date
 * @property string address
 * @property int province_id
 * @property int zipcode
 * @property string googleMap
 * @property int wallet
 * @property \DateTime end_package_date
 * @property array department
 * @property string facebook
 * @property string website
 * @property int clicked
 * @property int rating
 */
class Company extends RedBeanController
{
    use NameTrait;
    use ImageTrait;

    const ACCOUNT_FREE = 'free';
    const ACCOUNT_VIP = 'vip';
    const ACCOUNT_PREMIUM = 'premium';

    function __construct($id = 0)
    {
        parent::__construct($id);
    }

    /**
     * @return string
     */
    public function getAccountType()
    {
        return $this->dataModel->account_type;
    }

    /**
     * @param string $account_type
     */
    public function setAccountType($account_type)
    {
        $this->dataModel->account_type = $account_type;
    }

    /**
     * @return string
     */
    public function getLogoUrl()
    {
        return $this->dataModel->logo;
    }

    /**
     * @return CompanyType
     */
    public function getType()
    {
        return $this->dataModel->companytype_id;
    }

    /**
     * @param int CompanyType $type
     */
    public function setType($type)
    {
        $this->dataModel->companytype_id = $type;
    }

    /**
     * @return string
     */
    public function getFounder()
    {
        return $this->dataModel->founder;
    }

    /**
     * @param string $founder
     */
    public function setFounder($founder)
    {
        $this->dataModel->founder = $founder;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->dataModel->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->dataModel->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->dataModel->start_date;
    }

    /**
     * @param \DateTime $start_date
     */
    public function setStartDate($start_date)
    {
        $this->dataModel->start_date = $start_date;
    }

    /**
     * @return array
     */
    public function getTel()
    {
        return unserialize($this->dataModel->tel);
    }

    /**
     * @param array $tel
     */
    public function setTel($tel)
    {
        $this->dataModel->tel = serialize($tel);
    }

    /**
     * @return array
     */
    public function getFax()
    {
        return unserialize($this->dataModel->fax);
    }

    /**
     * @param array $fax
     */
    public function setFax($fax)
    {
        $this->dataModel->fax = serialize($fax);
    }

    /**
     * @return array
     */
    public function getOpenDate()
    {
        return $this->dataModel->open_date;
    }

    /**
     * @param array $open_date
     */
    public function setOpenDate($open_date)
    {
        $this->dataModel->open_date = $open_date;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->dataModel->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->dataModel->address = $address;
    }

    /**
     * @return Province
     */
    public function getProvinceId()
    {
        return $this->dataModel->province_provinceid;
    }

    /**
     * @param int Province $province_id
     */
    public function setProvinceId($province_id)
    {
        $this->dataModel->province_id = $province_id;
    }

    /**
     * @return int
     */
    public function getZipcode()
    {
        return $this->dataModel->zipcode;
    }

    /**
     * @param int $zipcode
     */
    public function setZipcode($zipcode)
    {
        $this->dataModel->zipcode = $zipcode;
    }

    /**
     * @return string
     */
    public function getGoogleMap()
    {
        return $this->dataModel->googleMap;
    }

    /**
     * @param string $googleMap
     */
    public function setGoogleMap($googleMap)
    {
        $this->dataModel->googleMap = $googleMap;
    }

    /**
     * @return int
     */
    public function getWallet()
    {
        return $this->dataModel->wallet;
    }

    /**
     * @param int $wallet
     */
    public function setWallet($wallet)
    {
        $this->dataModel->wallet = $wallet;
    }

    /**
     * @return \DateTime
     */
    public function getEndPackageDate()
    {
        return $this->dataModel->end_package_date;
    }

    /**
     * @param \DateTime $end_package_date
     */
    public function setEndPackageDate($end_package_date)
    {
        $this->dataModel->end_package_date = $end_package_date;
    }

    /**
     * @return array
     */
    public function getDepartment()
    {
        return $this->dataModel->department;
    }

    /**
     * @param array $department
     */
    public function setDepartment($department)
    {
        $this->dataModel->department = $department;
    }

    /**
     * @return string
     */
    public function getFacebook()
    {
        return $this->dataModel->facebook;
    }

    /**
     * @param string $facebook
     */
    public function setFacebook($facebook)
    {
        $this->dataModel->facebook = $facebook;
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
    public function getClicked()
    {
        return $this->dataModel->clicked;
    }

    /**
     * @param int $clicked
     */
    public function setClicked($clicked)
    {
        $this->dataModel->clicked = $clicked;
    }

    /**
     * @return int
     */
    public function getRating()
    {
        return $this->dataModel->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating($rating)
    {
        $this->dataModel->rating = $rating;
    }
}
