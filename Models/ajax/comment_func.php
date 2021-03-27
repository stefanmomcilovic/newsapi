<?php
require "../../includes/config/config.php";
$result = [];
$errors = [];
$username = str_replace(" ", "-", strip_tags($_POST["username"])) ;
$comment = strip_tags($_POST["comment"]);
$news_title = str_replace(" ", "-", strip_tags($_POST["news_title"]));

if(strlen($username) < 2){
    array_push($errors, "Username cannot be less than 2 characters!");
}

if(empty($username)){
    array_push($errors, "Username cannot be empty!");
}

if(strlen($comment) < 2){
    array_push($errors, "Comment cannot be less than 2 characters!");
}

if (empty($comment)) {
    array_push($errors, "Comment cannot be empty!");
}

if(empty($errors)){
    $insert = $DB->preparedQuery("INSERT INTO `news_comment`(`new_title`,`username`,`comment`) VALUES(:newTitle, :username, :comment)", array(":newTitle"=>$news_title, ":username"=> $username, ":comment"=> $comment));
    $select_user = $DB->preparedQueryFetch("SELECT * FROM `news_comment` WHERE `id`=:lastId", array(":lastId"=>$insert["lastId"]));
    if($select_user["rowCount"] > 0){
        $result["fetch"] = $select_user["fetch"];
        $result["success"] = 1;
    }
}else{
    $result["success"] = 0;
}

$result["errors"] = $errors;
echo json_encode($result);
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
?>