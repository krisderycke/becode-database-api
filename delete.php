<?php
require 'server.php';

try{
$sqlDelete= " DELETE FROM `my notes` WHERE `my notes`.`Title`is null";
$stmtDelete= exec($sqlDelete);



echo " lines has been deleted";
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}
unset($pdo);