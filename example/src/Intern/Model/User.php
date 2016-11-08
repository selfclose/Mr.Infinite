<?php
namespace Intern\Model;
use Intern\Controller\RedBeanController;

/**
 * @property int id
 * @property string username
 * @property string password
 * @property string name
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
 * @property string profile_image_filename
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

    /**
     * @var array
     */
    protected $skill_id = [];
    protected $custom_skill = [];

    private $is_valid = true;

    function __construct($tableId = 0)
    {
        $this->setTableName('wp_users');
        parent::__construct($tableId);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = wp_strip_all_tags(strtolower($username));
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
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
     * @return string
     */
    public function getNameEng()
    {
        return $this->name_eng;
    }

    /**
     * @param string $name_eng
     */
    public function setNameEng($name_eng)
    {
        $this->name_eng = wp_strip_all_tags($name_eng);
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = strip_tags($address);
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        if (is_email($email))
            $this->email = $email;
        else
            $this->is_valid = false;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        if (in_array($gender, array('m','f','n'), true))
            $this->gender = $gender;
        else
            $this->is_valid = false;
    }

    /**
     * @return string
     */
    public function getUserUrl()
    {
        return $this->userUrl;
    }

    /**
     * @param string $userUrl
     */
    public function setUserUrl($userUrl)
    {
        $this->userUrl = $userUrl;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param string $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param DateTime $birthDate
     */
    public function setBirthDate($birthDate)
    {
//        if ($birthDate instanceof DateTime)
        $this->birthDate = $birthDate;
    }

    /**
     * @return int
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param int $zipcode
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return int
     */
    public function getProvince_id()
    {
        return $this->province_id;
    }

    /**
     * @param int $province_id
     */
    public function setProvince_id($province_id)
    {
        $this->province_id = $province_id;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    public static function getUserData($user_id)
    {
        return get_userdata($user_id);
    }

    /**
     * @return string
     */
    public function getFacebook() {
        return $this->facebook;
    }

    /**
     * @param string $facebook
     */
    public function setFacebook( $facebook ) {
        $this->facebook = $facebook;
    }

    /**
     * @return string
     */
    public function getLine() {
        return $this->line;
    }

    /**
     * @param string $line
     */
    public function setLine( $line ) {
        $this->line = $line;
    }

    /**
     * @return mixed
     */
    public function getInstagram()
    {
        return $this->instagram;
    }

    /**
     * @param mixed $instagram
     */
    public function setInstagram($instagram)
    {
        $this->instagram = $instagram;
    }

    /**
     * @return string
     */
    public function getProfileImage()
    {
        return $this->profile_image;
    }

    /**
     * @return boolean
     */
    public function getIsConscripted()
    {
        return $this->is_conscripted;
    }

    /**
     * @param boolean $is_conscripted
     */
    public function setIsConscripted($is_conscripted)
    {
        $this->is_conscripted = $is_conscripted;
    }

    /**
     * @param int $user_id
     * @return DateTime
     */
    public static function getCreatedAt($user_id)
    {
        if (isset($user_id)) {
            $res = get_userdata($user_id)->user_registered;
        }
        else
        {
            $res = wp_get_current_user()->user_registered;
        }
        return $res;
    }

    /**
     * @return mixed
     */
    public function getLastUpdate()
    {
        //TODO: มาทำต่อ
    }

    /**
     * @return boolean
     */
    public function isGotJob()
    {
        return $this->got_job;
    }

    /**
     * @param boolean $got_job
     */
    public function setGotJob($got_job)
    {
        $this->got_job = $got_job;
    }

    /**
     * @param string $profile_image
     */
    public function setProfileImage($profile_image)
    {
        $this->profile_image = $profile_image;
    }

    /**
     * @param string $dateDob
     * @return int
     */
    public function getAge($dateDob = 'Y-m-d')
    {
        $day = date($dateDob,strtotime($this->getBirthDate()));
        $dobObject = new DateTime($day);
        $nowObject = new DateTime();

        $diff = $dobObject->diff($nowObject);
        return $diff->y;
    }
    
    public final function insert()
    {
        /* ----- CHECK EXIST -----*/
        if (username_exists($this->getUsername()) or email_exists($this->getEmail())) {
            return INTERN_STATE::USER_EXIST;
        }
        elseif (!$this->is_valid) {
            return INTERN_STATE::USER_CHEATING;
        }
        elseif ($newUserId =
            wp_insert_user([
                'user_login' => $this->getUsername(),
                'user_pass' => $this->getPassword(),
                'user_email' => $this->getEmail(),
                'display_name' => $this->getName(),
//                'first_name' => $this->
//                'last_name' => $this->
                
//        'role' => ''
            ])
        ) {
            //save user data data to meta
            $data = [
                'show_admin_bar_front' => 'false',
                'birth_date'    => $this->getBirthDate(),
                'eng_name'      => $this->getNameEng(),
                'user_url'      => $this->getUserUrl(),
                'description'   => $this->getDescription(),
                'address'       => $this->getAddress(),
                'gender'        => $this->getGender(),
                'province_id'   => $this->getProvince_id(),
                'zipcode'       => $this->getZipcode(),
                'facebook'      => $this->getFacebook(),
                'line'          => $this->getLine(),
                'instagram'     => $this->getInstagram(),
                'is_conscripted'=> $this->getIsConscripted(),
                'got_job'       => $this->isGotJob(),
//                'profile_image' => $this->getProfileImage(),
            ];
            foreach ($data as $key => $value) {
                update_user_meta($newUserId, $key, $value);
            }

            if (!empty($this->getProfileImage())) :
                INTERN_IMAGE::save($this->getProfileImage(), $this->getUsername().'.jpg', INTERN_SETTING::$image_path_intern, false);
            endif;

            return INTERN_STATE::SUCCESS;
        }
        return INTERN_STATE::UNKNOW_ERROR;
    }

    public final function load()
    {
        
    }

    public final function update()
    {
//        wp_update_user();
    }
}
