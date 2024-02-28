<?php
session_start();
$errors = 0;
$img = 8;
if(isset($_POST['btn'])){
    include "../connection/database.php";
    include "functions.php";
    try{
        $id = $_POST['newId'];
        sendNew($id);
        header("Location: ../index.php?page=waiting");

    }
    catch(PDOException $exception){
        http_response_code(500);
    }
}
else{
    http_response_code(404);
}