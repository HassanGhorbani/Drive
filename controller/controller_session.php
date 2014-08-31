<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 8/31/14
 * Time: 8:28 PM
 */

session_start();
$ip = $_SERVER['REMOTE_ADDR'];
$agent = $_SERVER['HTTP_USER_AGENT'];

if(!isset($_SESSION['user']) || $ip != $_SESSION['ip'] || $agent == $_SESSION['agent']){
    header("location:../login");
}
