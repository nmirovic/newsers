<?php
session_start();
$errors = 0;
$img = 8;
if(isset($_POST['btnAddNew'])){
    include "../connection/database.php"; 
    include "functions.php"; 
    try{
        $title = $_POST['title'];
        $content = $_POST['content'];
        $category = $_POST['category'];
        $file = $_FILES['picture'];  
        $_SESSION['titleValue'] = $title; 
        $_SESSION['contentValue'] = $content;     
        if(trim($title) == ""){
            $_SESSION['title'] = "Title must have between 10 and 80 characters";
            $errors++;
        }
        if(trim($content) == ""){
            $_SESSION['content'] = "Content should have at least 30 characters";
            $errors++;
        }
        if(is_uploaded_file($file['tmp_name'])){
            $name = $file['name'];
            $tempName = $file['tmp_name'];
            $size = $file['size'];
            $type = $file['type'];
            $errors = $file['error'];      
            
            $countErr = 0;
            $allopwedType = ["image/jpg", "image/jpeg", "image/png", "image/webp"];

            if(!in_array($type, $allopwedType)){
                $countErr++;
                $errors++;
                $_SESSION['typeError'] = "Allowed types are jpg, webp, jpeg or png";
            }
            if($countErr == 0){
                $newName = time()."_".$name;
                $src = "../img/".$newName;
                $alt = time()."-new";
                if(move_uploaded_file($tempName, $src)){    
                    if(addImg($newName, $alt)){
                        $img = $conn->lastInsertId();
                    }
                }
            }
        }
        if($category == "0"){
            $_SESSION['category'] = "Please select category";
            $errors++;
        }
        if($errors == 0){
            unset($_SESSION['titleValue']);
            unset($_SESSION['contentValue']);
            $new = addNew($title, $content, $category, $img);
            if($new){
                $_SESSION['successfullyAdd'] = "You successfuly added new";
            }
        }
        header("Location: ../index.php?page=add-new");
        
    }
    catch(PDOException $exception){
        http_response_code(500);
    }
}
else{
    http_response_code(404);
}