<?php
session_start();
header('Content-Type: application/json');
$errors = [];
if(isset($_POST['btn'])){
    include "../connection/database.php";
    include "functions.php";
    try{
        $comment = $_POST['comment'];
        $type = $_POST['type'];
        $table = $_POST['table'];
        $id = $table=="news" ? "news_id" : "comm_id";

        likeComment($table,$type,$comment,$id);
        echo json_encode(true);
    }
    catch(PDOException $exception){
        http_response_code(500);
    }
}
else{
    http_response_code(404);
}