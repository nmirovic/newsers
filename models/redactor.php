<?php
session_start();
header('Content-Type: application/json');
$errors = 0;
if(isset($_POST['btn'])){
    include "../connection/database.php";
    include "functions.php";
    try{
        $user = $_POST['user'];
        $category = $_POST['category'];
        $delete = $_POST['deleteCat'];

        if(manageJournalistsCategory($user, $category, $delete))
            echo json_encode(true);
    }
    catch(PDOException $exception){
        http_response_code(500);
    }
}
else{
    http_response_code(404);
}