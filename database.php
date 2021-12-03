<?php

class Database{

    public function getConnection() {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=php2021;charset=utf8',"root", "");
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,"false");
            return $pdo;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        }
}