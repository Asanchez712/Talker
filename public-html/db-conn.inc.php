<?php

require 'db-pswd.inc.php';

 try {

     //DOCKER
     $connection = new PDO('mysql:host=database;dbname=talker_db', DOCKER[0], DOCKER[1]);


    //  print "Success! Connected to the database!";

 } catch (PDOException $e) {
     print "Error!: " . $e->getMessage() . "<br/>";
     die();
 }

?>
