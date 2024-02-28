<?php
session_start();
header('Content-Type: application/json');

if(isset($_SESSION['user'])){
    include "../connection/database.php";
    include "functions.php";

    if($_SESSION['user']->role_id==1) {
        echo json_encode(selectAll("category"));
    }
    else echo json_encode(getUserCategory());
}
else http_response_code(404);