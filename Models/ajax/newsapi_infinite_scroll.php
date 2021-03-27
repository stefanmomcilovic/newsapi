<?php
    require "../../vendor/autoload.php";
    use jcobhams\NewsApi\NewsApi;

    $my_key = "29563a509cac4a99bde7982ffb97028e";
    $newsapi = new NewsApi($my_key);
    $page_size = (int)$_POST['page_size'];

    if(isset($_POST["search"])){
        if (strlen($_POST["search"]) < 3 || empty($_POST["search"]) || !isset($_POST["search"])) {
            header("Location: index.php?searchInvalid");
        }
        $q = $_POST["search"];
    }else{
        $q = "elon musk";
    }
    $every_news = $newsapi->getEverything($q, null, null, null, null, null, "en", null, $page_size, null);
    $content = '';
    foreach ($every_news->articles as $new){
        $content .= '<div class="col-sm-8 m-auto">
                    <a href="news.php?title='. str_replace(" ", "-", $new->title)  .'" class="news-link">
                        <div class="card text-center">
                            <img class="card-img-top img-fluid" src="'. $new->urlToImage .'" alt="NewsAPI Image Alt">
                            <div class="card-body">
                                <h2>'. $new->title .'</h2>
                                <p class="card-text">'. $new->description .'</p>
                                <p class="text-secondary news-date">'. date("d M Y", strtotime($new->publishedAt)) .'
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <br><br>';
    }

    echo $content;
?>