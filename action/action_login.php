<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 8/30/14
 * Time: 5:48 PM
 */
session_start();
require_once('../controller/controller_user.php');
$login_form = new user();

$username = $_POST['user'];
$password = $_POST['pass'];

if($_SESSION['captcha'] != $_POST['captcha']){
    header("location:../view/login");
}


/*
 * username check with clean_input_username function
 * if function return true
 * then go to next line
 */
if($login_form->clean_input_username($username)){

    if($login_form->clean_input_password($password)){ //check password with same way in clean_input_username

        /*
         * if username exist in database
         * get id and password of user from table users
         */
        if($login_form->is_user_available($username)){
            //user_data is array which have id and password of user
            $user_data = $login_form->get_user_info($username);

            //encrypt password with users id and input password
            $encrypt_password = $login_form->encrypt_password($password,$user_data['id_user']);

            //if encrypt_password was the same password in stored in database so logged in
            if($user_data['pass'] == $encrypt_password){
                echo "logged in";
                $_SESSION['user'] = $username;
                $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['agent'] = hash("md5",$_SERVER['HTTP_USER_AGENT']);

                //go to view/home directory
                header("location:../view/home");
            }
            else{
                echo "password incorrect"; //password wasn't match
            }
        }
        else{
            echo "user isn't available"; //error in line function is_user_available
        }
    }
    else{
        echo $login_form->error; //password error
    }
}
else{
    echo $login_form->error; //username error
}