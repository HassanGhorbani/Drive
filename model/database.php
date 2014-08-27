<?php
/*
 * in this class we connect to database
 * other class extends from this class
 */

/**
 * Class database
 * other Class extends this class to connect to database
 */
class database {

    protected $pdo;
    function __construct(){
        try{
            $this->pdo = new PDO('mysql:host=localhost;dbname=drive','root','');
        }
        catch(PDOException $e){
            echo "<h1>".$e->getMessage()."</h1>";
        }
    }
}