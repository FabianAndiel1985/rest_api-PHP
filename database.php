<?php

class Database{

    public function getConnection() {
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=php2021', "root", "");
            return $dbh;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        }
}