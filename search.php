<?php require "includes/header.php"; ?>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="text-center">All News about <?= $_GET["search"] ?></h1>
            <div class="all_news"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        const params = new URLSearchParams(window.location.search); // Search to find params in url
        var load = 20;
        loadMore(load);

        function loadMore(articles) {
            var page_size = articles;
            $.ajax({
                type: "POST",
                url: "Models/ajax/newsapi_infinite_scroll.php",
                data: {
                    search: params.get("search"),
                    page_size: page_size
                },
                success: function(res) {
                    $(".all_news").append(res);
                    load += 10;
                }
            });
        }
        $(window).scroll(function() {
            if ($(window).scrollTop() >= $(document).height() - $(window).height()) {
                loadMore(load);
            }
        });
    });
</script>
<?php require "includes/footer.php" ?>