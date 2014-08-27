<?php

require_once('database.php');
class model_user extends database {

    /**
     * this function return last number of anything in database
     * like max id in users
     * get name of table and column
     * and  return result as number
     */
    function get_max_id($table,$column){
        $sql = $this->pdo->query("select max($column) from $table");
        $sql->execute(); //run query in database
        $max_id = $sql->fetch(PDO::FETCH_COLUMN); //fetch index number of column in result
        return $max_id[0]; //index of column in result
    }

    /**
     * this function check user is available in users table
     * if user not fount return false. this result using in register and allow user to register
     * if user found return true. this result using in login. in login with this function check user is exist or not
     */
    function is_user_available($username){
        $sql = $this->pdo->query("SELECT count('$username') FROM users where email_number = '$username'");
        $sql->execute();
        $row_count = $sql->fetch(PDO::FETCH_COLUMN);
        $row_count = $row_count[0];
        if($row_count == 0){
            return false;
        }
        else{
            return true;
        }


    }

    /**
     * get user info with username
     * return data as array
     */
    function get_user_info($username){
        $sql = $this->pdo->query("SELECT id_user,pass FROM users WHERE email_number = '$username'");
        $sql->execute();
        $data = $sql->fetch(PDO::FETCH_NAMED);
        return $data;
    }

    /**
     * this function insert new user
     * get the username from clean_input_user
     * and
     * get the password from encrypt_password
     * save data in users table
     * @param $username
     * @param $password
     */
    function insert_new_user($username,$password){
            $sql = $this->pdo->query("INSERT INTO users (email_number,pass) VALUES ('$username','$password')");
            $sql->execute();
    }
}