<?php
require "includes/header.php";
$title = $_GET["title"];
if (empty($title) || !isset($title)) {
    header("Location: index.php?InvalidNews");
}
require "Models/newsapi_single_page.php";
$title = str_replace("-", " ", $title);
?>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="text-center">All News Related To <?= $title ?></h2>
            <br><br>
        </div>
        <?php

        ?>
        <?php
        $new = (array)$every_news->articles[0];
        if (array_search($title, $new)) :
            $links = preg_match_all("/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/", $new["author"], $results);
            foreach (array_unique($results[0])  as $link) {
                $new["author"] = str_replace($link, '<a href="' . $link . '" target="_blank">' . $link . '</a>', $new["author"]);
            }
        ?>
            <div class="col-sm-12">
                <img class="img-fluid d-flex m-auto" src="<?= $new["urlToImage"] ?>" alt="NewsAPI Image Alt">
                <h1 class="text-center"><?= $new["title"] ?></h1>
                <p><?= $new["content"] ?></p>
                <p>News author <?= $new["author"] ?></p>
                <p>Source from <a href="<?= $new["url"] ?>" target="_blank"><?= $new["url"] ?></a></p>
                <p class="text-secondary"><?= date("d M Y", strtotime($new['publishedAt'])) ?></p>
                <div class="text-center">
                    <span class="fb-share-button mr-1" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-size="small"><a target="_blank" href="https://facebook.com/sharer/sharer.php?u=<?= 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>" class="fb-xfbml-parse-ignore"><i class="fab fa-facebook fa-2x text-primary"></i></a></span>
                    <span class="mr-1"> <a href="whatsapp://send?text=<?= 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>" data-action="share/whatsapp/share" target="_blank"><i class="fab fa-whatsapp fa-2x text-success"></i></a></span>
                    <span class="mr-1"><a href="https://twitter.com/share?url=<?= 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>" data-show-count="true" target="_blank"><i class="fab fa-twitter fa-2x text-primary"></i></a></span>
                    <span class="mr-1">
                        <a href="https://t.me/share/url?url=<?= 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>" target="_blank">
                            <i class="fab fa-telegram fa-2x text-primary"></i>
                        </a>
                    </span>
                </div>

                <br><br>
            </div>
        <?php endif ?>
        <div class="col-sm-12">
            <form method="post" id="comment-form">
                <div class="form-group">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username"><br>
                    <textarea class="form-control" id="commentHere" placeholder="Enter the comment here"></textarea>
                    <input type="submit" value="Comment" class="btn post-comment" id="submitComment">
                </div>
            </form>
            <br>
        </div>
        <div class="col-sm-12">
            <p id="errors" class='text-center text-danger'></p>
        </div>
        <div class="showAllComments w-100">
            <div class="col-sm-12">
                <div class="d-flex">
                    <p class="username"></p>
                    <div class="justify-content-end w-100">
                        <p class="commentText"></p>
                        <p class="text-secondary text-right created_at"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        const params = new URLSearchParams(window.location.search); // Search to find params in url

        $("#submitComment").click(function(e) {
            e.preventDefault();
            var form_data = {
                username: $("#username").val(),
                comment: $("#commentHere").val(),
                news_title: params.get("title")
            };

            $.ajax({
                type: "POST",
                url: "Models/ajax/comment_func.php",
                data: form_data,
                dataType: "json",
                encode: true,
                success: function(e) {
                    if (e.fetch) {
                        var username = $(".username");
                        var commentText = $(".commentText");
                        var created_at = $(".created_at");

                        username.text(e.fetch.username);
                        commentText.text(e.fetch.comment);
                        created_at.text(e.fetch.created_at);
                        document.getElementById("errors").innerHTML = "";
                        $("#username").val("");
                        $("#commentHere").val("");
                        loadAllComments();
                    }

                    if (e.errors || e.errors.length != 0) {
                        e.errors.forEach(function(error) {
                            document.getElementById("errors").innerHTML = error;
                        });
                    }
                }
            });
        });

        loadAllComments();

        function loadAllComments() {
            var news_title = params.get("title"); // Gettings param title
            var comment = '';
            $.ajax({
                type: "POST",
                url: "Models/ajax/all_comments_func.php",
                data: {
                    news_title: news_title
                },
                dataType: "json",
                encode: true,
                success: function(e) {
                    if (e.fetchAll) {
                        e.fetchAll.forEach(function(res) {
                            comment += '<div class="col-sm-12"><div class="d-flex"><p class="username">' + res.username + '</p><div class="justify-content-end w-100"><p class="commentText">' + res.comment + '</p> <p class="text-secondary text-right created_at">' + res.created_at + '</p></div></div></div><hr>';
                        });
                    }
                    $(".showAllComments").html(comment);
                }
            });
        }
    });
</script>
<?php require "includes/footer.php"; ?>
