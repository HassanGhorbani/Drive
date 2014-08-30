<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 8/30/14
 * Time: 5:48 PM
 */
require_once('../controller/controller_user.php');
$login_form = new user();

$username = $_POST['user'];
$password = $_POST['pass'];
echo "این صفحه فقط برای رفع اشکال است<br>";

/*
 * username check with clean_input_username function
 * if function return true
 * then go to next line
 */
if($login_form->clean_input_username($username)){

    //if input username wasn't exist in database so go to the next line
    if($login_form->is_user_available($username) == false){

        if($login_form->clean_input_password($password)){ //if this function return true that mean password is safe and clean

            $last_id =1 + $login_form->get_max_id("users","id_user"); //get_max_id(Name of table , Name of column)
            $encrypt_password = $login_form->encrypt_password($password,$last_id); //hash password with last id + 1 and input password
            $login_form->insert_new_user($last_id,$username,$encrypt_password);
            echo "Successful";
        }
        else{
            echo $login_form->error; //password is not safe and clean
        }
    }
    else{
        echo "Try another user"; //error in function is_user_available which mean user is exist in database
    }
}
else{
    echo $login_form->error; //error from clean_input_username which mean username is empty or not email or not clean and safe
}
