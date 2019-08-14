<?php
require 'server.php';


try{
    // $pdo = new PDO("mysql:host=localhost;dbname=note_app", "root", "");
    // // Set the PDO error mode to exception
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sqlDelete= "DELETE FROM `my notes` WHERE `Title` LIKE '%in%'";
$stmtDelete= $pdo->prepare($sqlDelete);
$stmtDelete->execute();
;



echo " lines have been deleted";
} catch(PDOException $e){
    die("ERROR: Could not execute $sql. " . $e->getMessage());
}
unset($pdo);
?>