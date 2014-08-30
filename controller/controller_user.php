<?php
/*
 * this class has function that use in login and register page's
 */
require_once('../model/model_user.php');

class user extends model_user {

    public $error;

    /**
     * this function get username
     * detect username is phone number or an email
     * return phone number
     * validate and sanitize email and return ir
     * @param $username
     * @return bool
     */
    function clean_input_username($username){
        if(!empty($username)){ //check username is not empty

            if(is_numeric($username) && strlen($username)>11){
                return true;//user is phone number
            }

            elseif(filter_var($username,FILTER_VALIDATE_EMAIL) && filter_var($username,FILTER_SANITIZE_EMAIL)){
                return true; //email is clean and validate
            }

            else{
                $this->error = 'unknown'; //user is unknown input type
            }
        }
        else{
            $this->error = 'empty';//input user is empty
        }
    }

    /**
     * this function get input password
     * return clean and safe password
     * @param $password
     * @return bool
     */
    function clean_input_password($password){
        if(!empty($password) && strlen($password)>=8 ){
            if($password == filter_var($password,FILTER_SANITIZE_STRING)){
                return true;
            }
            else{
                $this->error = 'unsafe';
            }
        }
        else{
            $this->error = 'short';
        }
    }

    /**
     * this function get clean and safe password from clean_input_password as password
     * and get salt from get_max_id which in model_user class
     * hash each one separately and return together
     * @param $password
     * @param $salt
     * @return string
     */
    function encrypt_password($password,$salt){
        return hash("sha256",$password).hash("sha256",$salt);
    }

}