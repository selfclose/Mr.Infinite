<?php
namespace wp_infinite\Model;

use wp_infinite\Controller\WPModelController;

class WPUsers extends WPModelController
{
    protected $table = 'wp_users';

    protected $ID;
    protected $user_login;
    protected $user_pass;
    protected $user_nicename;
    protected $user_email;
    protected $user_url;
    protected $user_registered;
    protected $user_activation_key;
    protected $user_status;
    protected $display_name;

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @param mixed $ID
     */
    public function setID($ID)
    {
        $this->ID = $ID;
    }

    /**
     * @return mixed
     */
    public function getUserLogin()
    {
        return $this->user_login;
    }

    /**
     * @param mixed $user_login
     */
    public function setUserLogin($user_login)
    {
        $this->user_login = $user_login;
    }

    /**
     * @return mixed
     */
    public function getUserPass()
    {
        return $this->user_pass;
    }

    /**
     * @param mixed $user_pass
     */
    public function setUserPass($user_pass)
    {
        $this->user_pass = $user_pass;
    }

    /**
     * @return mixed
     */
    public function getUserNicename()
    {
        return $this->user_nicename;
    }

    /**
     * @param mixed $user_nicename
     */
    public function setUserNicename($user_nicename)
    {
        $this->user_nicename = $user_nicename;
    }

    /**
     * @return mixed
     */
    public function getUserEmail()
    {
        return $this->user_email;
    }

    /**
     * @param mixed $user_email
     */
    public function setUserEmail($user_email)
    {
        $this->user_email = $user_email;
    }

    /**
     * @return mixed
     */
    public function getUserUrl()
    {
        return $this->user_url;
    }

    /**
     * @param mixed $user_url
     */
    public function setUserUrl($user_url)
    {
        $this->user_url = $user_url;
    }

    /**
     * @return mixed
     */
    public function getUserRegistered()
    {
        return $this->user_registered;
    }

    /**
     * @param mixed $user_registered
     */
    public function setUserRegistered($user_registered)
    {
        $this->user_registered = $user_registered;
    }

    /**
     * @return mixed
     */
    public function getUserActivationKey()
    {
        return $this->user_activation_key;
    }

    /**
     * @param mixed $user_activation_key
     */
    public function setUserActivationKey($user_activation_key)
    {
        $this->user_activation_key = $user_activation_key;
    }

    /**
     * @return mixed
     */
    public function getUserStatus()
    {
        return $this->user_status;
    }

    /**
     * @param mixed $user_status
     */
    public function setUserStatus($user_status)
    {
        $this->user_status = $user_status;
    }

    /**
     * @return mixed
     */
    public function getDisplayName()
    {
        return $this->display_name;
    }

    /**
     * @param mixed $display_name
     */
    public function setDisplayName($display_name)
    {
        $this->display_name = $display_name;
    }

    public function InsertAction($force = false)
    {
        global $wpdb;
        print_r(get_class_methods($this));exit();
        $wpdb->get_row("INSERT INTO `{$this->table}` (user_login) VALUES ()");
        wp_create_user($this->getUserLogin(), $this->getUserPass());
        //wp_create_user();
    }

    static function find($id)
    {
        global $wpdb;
        return $wpdb->get_row("SELECT * FROM wp_users WHERE ID = '{$id}'");
    }

    /**
     * @return int
     */
    static function count()
    {
        global $wpdb;
        return $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->users}");
    }

}
