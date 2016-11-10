<?php
namespace Intern\Model;
use Intern\Controller\RedBeanController;

/**
 * @property int id
 * @property string username
 * @property string password
 * @property string display_name
 * @property string name_eng
 * @property string address
 * @property string email
 * @property string gender
 * @property string userUrl
 * @property string role
 * @property string company
 * @property string birthDate
 * @property int zipcode
 * @property int province_id
 * @property string description
 * @property string facebook
 * @property string instagram
 * @property string line
 * @property string profile_image
 * @property bool is_conscripted
 * @property array badge
 * @property bool got_job = false
 * @property string favorite = [] //company_id
 * @property string company_id //หาก user นี้เป็นพนักงานบริษัท
 * @property string department_id
 * @property string bookmark = []
 * @property string age = 0 //no set no save
**/
class User extends RedBeanController
{
    protected $table = 'wp_users';

    protected $id;
    protected $username;
    protected $password;
    protected $name;
    protected $name_eng;
    protected $address;
    protected $email;
    protected $gender = 'n';
    protected $userUrl;
    protected $role;
    protected $company;
    protected $birthDate;
    protected $zipcode;
    protected $province_id;
    protected $description;
    protected $facebook;
    protected $instagram;
    protected $line;
    protected $profile_image; //imagePath (ไม่ใช้่ของ wordpress)
    protected $profile_image_filename;
    protected $is_conscripted = false; //ผ่านเกณฑ์ทหารหรือยัง?
    protected $badge; //TODO: BadgeModel
    protected $got_job = false;

    protected $favorite = []; //company_id
    //companyModel
    protected $company_id; //หาก user นี้เป็นพนักงานบริษัท
    protected $department_id;
    protected $bookmark = [];
    protected $age = 0; //no set no save

    protected $website = [];

    /**
     * @var array
     */
    protected $skill_id = [];
    protected $custom_skill = [];

    private $is_valid = true;

    function __construct($id = 0)
    {
        parent::__construct($id, true);
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->dataModel->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->dataModel->username = $username;
    }

    //TODO: Use something such as Wordpress for make password.
    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->dataModel->password = $password;
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->dataModel->display_name;
    }

    /**
     * @param string $display_name
     */
    public function setDisplayName($display_name)
    {
        $this->dataModel->display_name = $display_name;
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
     * @return string
     */
    public function getEmail()
    {
        return $this->dataModel->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->dataModel->email = $email;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->dataModel->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->dataModel->gender = $gender;
    }

    /**
     * @return string
     */
    public function getUserUrl()
    {
        return $this->dataModel->userUrl;
    }

    /**
     * @param string $userUrl
     */
    public function setUserUrl($userUrl)
    {
        $this->dataModel->userUrl = $userUrl;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->dataModel->role;
    }

    /**
     * @param string $role
     */
    public function setRole($role)
    {
        $this->dataModel->role = $role;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->dataModel->company;
    }

    /**
     * @param string $company
     */
    public function setCompany($company)
    {
        $this->dataModel->company = $company;
    }

    /**
     * @return string
     */
    public function getBirthDate()
    {
        return $this->dataModel->birthDate;
    }

    /**
     * @param string $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->dataModel->birthDate = $birthDate;
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
     * @return int
     */
    public function getProvinceId()
    {
        return $this->dataModel->province_id;
    }

    /**
     * @param int $province_id
     */
    public function setProvinceId($province_id)
    {
        $this->dataModel->province_id = $province_id;
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
    public function getInstagram()
    {
        return $this->dataModel->instagram;
    }

    /**
     * @param string $instagram
     */
    public function setInstagram($instagram)
    {
        $this->dataModel->instagram = $instagram;
    }

    /**
     * @return string
     */
    public function getLine()
    {
        return $this->dataModel->line;
    }

    /**
     * @param string $line
     */
    public function setLine($line)
    {
        $this->dataModel->line = $line;
    }

    /**
     * @return string
     */
    public function getProfileImage()
    {
        return $this->dataModel->profile_image;
    }

    /**
     * @param string $profile_image
     */
    public function setProfileImage($profile_image)
    {
        $this->dataModel->profile_image = $profile_image;
    }

    /**
     * @return boolean
     */
    public function isIsConscripted()
    {
        return $this->dataModel->is_conscripted;
    }

    /**
     * @param boolean $is_conscripted
     */
    public function setIsConscripted($is_conscripted)
    {
        $this->dataModel->is_conscripted = $is_conscripted;
    }

    /**
     * @return array
     */
    public function getBadge()
    {
        return $this->dataModel->badge;
    }

    /**
     * @param array $badge
     */
    public function setBadge($badge)
    {
        $this->dataModel->badge = $badge;
    }

    /**
     * @return boolean
     */
    public function isGotJob()
    {
        return $this->dataModel->got_job;
    }

    /**
     * @param boolean $got_job
     */
    public function setGotJob($got_job)
    {
        $this->dataModel->got_job = $got_job;
    }

    /**
     * @return string
     */
    public function getFavorite()
    {
        return $this->dataModel->favorite;
    }

    /**
     * @param string $favorite
     */
    public function setFavorite($favorite)
    {
        $this->dataModel->favorite = $favorite;
    }

    /**
     * @return string
     */
    public function getCompanyId()
    {
        return $this->dataModel->company_id;
    }

    /**
     * @param string $company_id
     */
    public function setCompanyId($company_id)
    {
        $this->dataModel->company_id = $company_id;
    }

    /**
     * @return string
     */
    public function getDepartmentId()
    {
        return $this->dataModel->department_id;
    }

    /**
     * @param string $department_id
     */
    public function setDepartmentId($department_id)
    {
        $this->dataModel->department_id = $department_id;
    }

    /**
     * @return string
     */
    public function getBookmark()
    {
        return unserialize($this->dataModel->bookmark);
    }

    /**
     * @param string $bookmark
     */
    public function setBookmark($bookmark)
    {
        $this->dataModel->bookmark = serialize($bookmark);
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->dataModel->age;
    }

    /**
     * @param int $age
     */
    public function setAge($age)
    {
        $this->dataModel->age = $age;
    }

    /**
     * @return array
     */
    public function getWebsite()
    {
        return unserialize($this->dataModel->website);
    }

    /**
     * @param array $website
     */
    public function setWebsite($website)
    {
        $this->dataModel->website = serialize($website);
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


}
