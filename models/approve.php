<?php

session_start();
include "../connection/database.php";
include "functions.php";
//if(isset($_POST['id'])){
    $id = $_POST['id'];

    try {
        if(isset($_POST['approve'])) approveNew($id);
        else if(isset($_POST['deny'])) denyNew($id);
        header("Location: ../index.php?page=approval");
    }
    catch(PDOException $exception){
        http_response_code(500);
    }
//}

//else{
//    http_response_code(404);
//}