<?php
//header("HTTP/1.0 404 Not Found");

function checkErrors($reg, $var){
    $error = false;
    if(!preg_match($reg, $var)){
        $error = true;
    }
    return $error;
}
function selectAll($table){
    global $conn;
    $query = "SELECT * FROM $table";
    $result = $conn->query($query)->fetchAll();
    return $result;
}
function selectHeadlines(){
    global $conn;
    $query = "SELECT n.*,c.name,i.*, (SELECT COUNT(*) FROM comments WHERE news_id=n.news_id) AS 'comments' FROM img i INNER JOIN news n ON i.img_id=n.img_id INNER JOIN category c ON n.category_id=c.category_id WHERE n.active=1 ORDER BY n.date DESC LIMIT 11";
    $result = $conn->query($query)->fetchAll();
    return $result;
}
function trendingNews(){
    global $conn;
    $query = "SELECT n.news_id, n.title, n.content, n.date, n.img_id, n.category_id, ca.name, i.* FROM news n INNER JOIN category ca ON n.category_id=ca.category_id  INNER  JOIN img i ON n.img_id=i.img_id LEFT JOIN comments c ON n.news_id=c.news_id WHERE n.active=1 GROUP BY n.news_id, n.title, n.content, n.date, n.img_id, n.category_id, ca.name ORDER BY COUNT(c.comm_id) DESC LIMIT 4";
    $result = $conn->query($query)->fetchAll();
    return $result;
}
function countNews($id){
    global $conn;
    $query = "SELECT COUNT(*) AS number FROM news WHERE category_id = :id";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':id', $id);
    $prepare->execute();

    $result = $prepare->fetch();
    return $result;
}
function sendNew($id){
    global $conn;
    $query = "UPDATE news SET active=2 WHERE news_id=:id";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':id', $id);

    $result = $prepare->execute();
    return $result;
}
function waitingNews(){
    global $conn;
    $query = "SELECT * FROM news WHERE user_id=:user AND active=3 OR active=2";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':user', $_SESSION['user']->user_id);
    $prepare->execute();

    $result = $prepare->fetchAll();
    return $result;
}
function topCategories($id){
    global $conn;
    $query = "SELECT * FROM img i INNER JOIN news n ON i.img_id=n.img_id INNER JOIN category c ON n.category_id=c.category_id WHERE n.category_id=:id AND n.active=1 ORDER BY n.date DESC LIMIT 2";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':id', $id);
    $prepare->execute();

    $result = $prepare->fetchAll();
    return $result;
}
function forApproval(){
    global $conn;
    $query = "SELECT * FROM news WHERE active=2 AND category_id IN (SELECT category_id FROM category_users WHERE user_id=:user)";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':user', $_SESSION['user']->user_id);
    $prepare->execute();

    $result = $prepare->fetchAll();
    return $result;
}
function manageJournalists(){
    global $conn;
    $query = "SELECT * FROM users WHERE role_id=3";

    return $conn->query($query)->fetchAll();
}
function approveNew($id){
    global $conn;

    $query = "UPDATE news SET active=1 WHERE news_id=:id";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':id', $id);
    return $prepare->execute();
}
function denyNew($id){
    global $conn;

    $query = "DELETE FROM news WHERE news_id=:id";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':id', $id);
    return $prepare->execute();
}
function singleNew($id){
    global $conn;
    $query = "SELECT * FROM img i INNER JOIN news n ON i.img_id=n.img_id INNER JOIN category c on n.category_id=c.category_id WHERE n.news_id = :id";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':id', $id);
    $prepare->execute();

    return $prepare->fetch();
}
function registration($name, $lastName, $email, $password, $role){
    global $conn;
    $query = "INSERT INTO users(name, last_name, email, password, role_id) VALUES (:name, :lastName, :email, :password, :role)";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':name', $name);
    $prepare->bindParam(':lastName', $lastName);
    $prepare->bindParam(':email', $email);
    $prepare->bindParam(':password', $password);
    $prepare->bindParam(':role', $role);

    $result = $prepare->execute();
    return $result;
}
function manageJournalistsCategory($user, $category, $delete){
    global $conn;

    $query = "";
    if($delete == 1)
        $query = "DELETE FROM category_users WHERE user_id=:user AND category_id=:category";
    else
        $query = "INSERT INTO category_users(user_id, category_id) VALUES (:user,:category)";

    $prepare = $conn->prepare($query);

    $prepare->bindParam(':user', $user);
    $prepare->bindParam(':category', $category);

    $result = $prepare->execute();
    return $result;
}
function userCategories($user, $category){
    global $conn;
    $query = "INSERT INTO category_users(user_id, category_id) VALUES(:user, :category)";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':user', $user);
    $prepare->bindParam(':category', $category);

    $result = $prepare->execute();
    return $result;
}
function login($email, $password){
    global $conn;
    $query = "SELECT * FROM roles r INNER JOIN users u ON r.role_id = u.role_id INNER JOIN profile_img p on u.profile_img_id = p.profile_img_id WHERE u.email = :email AND u.password = :password AND u.active = 0";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':email', $email);
    $prepare->bindParam(':password', $password);
    $prepare->execute();

    $result = $prepare->fetch();
    return $result;
}
function checkPassword($email, $password){
    global $conn;
    $query = "SELECT password FROM users WHERE email = :email AND password = :password";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':password', $password);
    $prepare->bindParam(':email', $email);
    $prepare->execute();

    $result = $prepare->fetch();
    return $result;
}
function checkActive($email){
    global $conn;
    $query = "SELECT active FROM users WHERE email = :email";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':email', $email);
    $prepare->execute();

    $result = $prepare->fetch();
    return $result;
}
function checkEmail($email){
    global $conn;
    $query = "SELECT email FROM users WHERE email = :email";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':email', $email);
    $prepare->execute();

    $result = $prepare->fetch();
    return $result;
}
function addProfilePicture($alt, $src){
    global $conn;
    $query = "INSERT INTO profile_img(alt, src) VALUES(:alt, :src)";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':alt', $alt);
    $prepare->bindParam(':src', $src);

    $result = $prepare->execute();
    return $result;
}
function updateData($id, $column, $value){
    global $conn;

    $query = "UPDATE users SET $column = :value WHERE user_id = :id";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':id', $id);
    $prepare->bindParam(':value', $value);

    $result = $prepare->execute();
    return $result;
}
function updateTable($id, $table, $column, $value, $where){
    global $conn;

    $query = "UPDATE $table SET $column = :value WHERE $where = :id";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':id', $id);
    $prepare->bindParam(':value', $value);

    $result = $prepare->execute();
    return $result;
}
function addCategory($name){
    global $conn;
    $query = "INSERT INTO category(name) VALUES(:name)";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':name', $name);

    $result = $prepare->execute();
    return $result;
}
function checkCat($name){
    global $conn;
    $query = "SELECT name FROM category WHERE name = :name";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':name', $name);
    $prepare->execute();

    $result = $prepare->fetch();
    return $result;
}
function getComments($id){
    global $conn;
    $query = "SELECT * FROM comments WHERE news_id = :id ORDER BY comment_date DESC";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':id', $id);
    $prepare->execute();

    $result = $prepare->fetchAll();
    return $result;
}
function postComment($comment, $new, $author){
    global $conn;
    $query = "INSERT INTO comments(content, news_id, author) VALUES(:comment, :new, :author)";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':comment', $comment);
    $prepare->bindParam(':new', $new);
    $prepare->bindParam(':author', $author);

    $result = $prepare->execute();
    return $result;
}
function likeComment($table, $type, $comment, $id){
    global $conn;
    $query = "UPDATE $table SET $type=$type+1 WHERE $id=:comment";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':comment', $comment);

    $result = $prepare->execute();
    return $result;
}
function deleteComment($id, $reply){
    global $conn;

    $query = "DELETE FROM comments WHERE comm_id = :id";

    $prepare = $conn->prepare($query);

    $prepare->bindParam(':id', $id);

    $result = $prepare->execute();
    return $result;
}
function changeStatus($id, $change, $value){
    global $conn;
    if($value == "role"){
        $query = "UPDATE users SET role_id = :change WHERE user_id = :id";
    }
    else if($value == "active"){
        $query = "UPDATE users SET active = :change WHERE user_id = :id";
    }
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':id', $id);
    $prepare->bindParam(':change', $change);

    $result = $prepare->execute();
    return $result;
}
function getUserCategory($id = null){
    global $conn;
    $query = "SELECT * FROM category c INNER JOIN category_users ca ON c.category_id=ca.category_id WHERE ca.user_id=:id";
    $prepare = $conn->prepare($query);

    if($id == null) $prepare->bindParam(':id', $_SESSION['user']->user_id);
    else $prepare->bindParam(':id', $id);

    $prepare->execute();

    $result = $prepare->fetchAll();
    return $result;
}
function diffCategories($journalist){
    global $conn;
    $query = "SELECT c.* FROM category c LEFT JOIN category_users cu1 ON c.category_id = cu1.category_id AND cu1.user_id = :journalist LEFT JOIN category_users cu2 ON c.category_id = cu2.category_id AND cu2.user_id = :moderator WHERE cu1.category_id IS NULL AND cu2.category_id IS NOT NULL;
";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':moderator', $_SESSION['user']->user_id);
    $prepare->bindParam(':journalist', $journalist);

    $prepare->execute();

    $result = $prepare->fetchAll();
    return $result;
}
function addNew($title, $content, $category_id, $img_id){
    global $conn;
    $query = "INSERT INTO news(title, content, category_id, img_id, user_id) VALUES (:title, :content, :category_id, :img_id, :user_id)";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':title', $title);
    $prepare->bindParam(':content', $content);
    $prepare->bindParam(':category_id', $category_id);
    $prepare->bindParam(':img_id', $img_id);
    $prepare->bindParam(':user_id', $_SESSION['user']->user_id);

    $result = $prepare->execute();
    return $result;
}
function updateNew($id, $title, $content, $category){
    global $conn;

    $query = "UPDATE news SET title = :title, content = :content, category_id = :category WHERE news_id = :id";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':title', $title);
    $prepare->bindParam(':content', $content);
    $prepare->bindParam(':category', $category);
    $prepare->bindParam(':id', $id);

    $result = $prepare->execute();
    return $result;
}
function addImg($src, $alt){
    global $conn;
    $query = "INSERT INTO img(src, alt) VALUES(:src, :alt)";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':src', $src);
    $prepare->bindParam(':alt', $alt);

    $result = $prepare->execute();
    return $result;
}
function deleteFunction($table, $name, $id){
    global $conn;
    $query = "DELETE FROM $table WHERE $name = :id";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':id', $id);

    $result = $prepare->execute();
    return $result;
}
function sendMessage($name, $email, $message){
    global $conn;
    $query = "INSERT INTO messages(name, email, message) VALUES(:name, :email, :message)";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(':name', $name);
    $prepare->bindParam(':email', $email);
    $prepare->bindParam(':message', $message);

    $result = $prepare->execute();
    return $result;
}
function allNews2($filter, $sort, $limit = 0){
    global $conn;
    
    $criteria = "";
    if($filter != null && $filter != 0){
        $criteria = " AND c.category_id = :cat ";
    }
    if($sort != null && $sort != 0){
        if($sort == 1){
            $criteria.="ORDER BY n.date ";
        }
        else{
            $criteria.="ORDER BY n.date DESC ";
        }
    }

    $query = "SELECT * FROM img i INNER JOIN news n ON i.img_id=n.img_id INNER JOIN category c ON n.category_id=c.category_id WHERE n.active=1 ".$criteria."LIMIT :limit, 4";
    $prepare = $conn->prepare($query);


    $limit = ((int)$limit) * 4;
    $prepare->bindParam(":limit", $limit, PDO::PARAM_INT);
    if($filter != null && $filter != 0){
        $prepare->bindParam(":cat", $filter);
    }
    $prepare->execute();

    $result = $prepare->fetchAll();
    return $result;
}
function getActUser($id){
    global $conn;
    
    $query = "SELECT user_id, date, active FROM users WHERE user_id = :id";
    $prepare = $conn->prepare($query);

    $prepare->bindParam(":id", $id);

    $prepare->execute();

    $result = $prepare->fetch();
    return $result;
}
function newsNumber($filter){
    global $conn;

    $criteria = "";
    if($filter != null && $filter != 0){
        $criteria = " AND category_id = :category";
    }
    
    $query = "SELECT COUNT(*) AS number FROM news WHERE active=1 ".$criteria;

    $prepare = $conn->prepare($query);

    if($filter != null && $filter != 0){
        $prepare->bindParam(":category", $filter);
    }
    $prepare->execute();

    $result = $prepare->fetch();

    return $result;
}