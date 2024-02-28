<?php
session_start();
header('Content-Type: application/json');
$errors = 0;
if(isset($_POST['btn'])){
    include "../connection/database.php"; 
    include "functions.php"; 
    try{
        $comment = $_POST['comment'];
        $author = $_POST['author'];
        $idNew = $_POST['idNew'];
        $_SESSION['commentValue'] = $comment;
        $_SESSION['authorValue'] = $author;

        if(trim($comment) == "") {
            $_SESSION['comment'] = "Please enter comment";
            $errors++;
        }
        if(trim($author) == "") {
            $_SESSION['author'] = "Please enter your name";
            $errors++;
        }

        if($errors == 0){
            if(postComment($comment, $idNew, $author)){
                unset($_SESSION['commentValue']);
                unset($_SESSION['authorValue']);
                $_SESSION['successfullyAdd'] = "You successfully added comment";
            }
        }
        header("Location: ../index.php?page=single&single=".$idNew);
    }
    catch(PDOException $exception){
        http_response_code(500);
    }
}
else{
    http_response_code(404);
}