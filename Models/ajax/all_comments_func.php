<?php
require "../../includes/config/config.php";
$result = [];
$news_title = $_POST["news_title"];
$all_comments = $DB->preparedQueryFetchAll("SELECT * FROM `news_comment` WHERE `new_title`=:title ORDER BY `created_at` DESC", [":title"=> $news_title]);
if($all_comments["rowCount"] > 0){
    $result["fetchAll"] = $all_comments["fetchAll"];
}
echo json_encode($result);
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
?>