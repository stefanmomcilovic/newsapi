<?php
    require "vendor/autoload.php";
    use jcobhams\NewsApi\NewsApi;

    $my_key = "29563a509cac4a99bde7982ffb97028e";
    $newsapi = new NewsApi($my_key);
    $page_size = 20;

    if(isset($_GET["search"])){
        if (strlen($_GET["search"]) < 3 || empty($_GET["search"]) || !isset($_GET["search"])) {
            header("Location: index.php?searchInvalid");
        }
        $q = $_GET["search"];
    }else{
        $q = "elon musk";
    }

    $every_news = $newsapi->getEverything((isset($_GET["title"]) || !empty($_GET["title"]) ? $_GET["title"] : $q), null, null, null, null, null, "en", null, $page_size, null);
?>