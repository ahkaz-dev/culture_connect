<?php 
$query_artl = $pdo->prepare("SELECT Name, Id FROM articles");
$query_artl->execute();
$articles_query_result = $query_artl->fetchAll(PDO::FETCH_ASSOC);

$query_news = $pdo->prepare("SELECT Name, Id FROM news");
$query_news->execute();
$news_query_result = $query_news->fetchAll(PDO::FETCH_ASSOC);

$query_prod = $pdo->prepare("SELECT Name, Id FROM product");
$query_prod->execute();
$products_query_result = $query_prod->fetchAll(PDO::FETCH_ASSOC);

$query_museums = $pdo->prepare("SELECT Name, Id FROM museums");
$query_museums->execute();
$museums_query_result = $query_museums->fetchAll(PDO::FETCH_ASSOC);
?>
<style>

</style>
<footer class="bg-light text-center text-lg-start">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase mooli-regular">Culture Connect</h5>
                    <p>
                    Благодаря инновационным программам, мероприятиям и цифровым платформам, мы связываем людей из разных уголков мира, поощряя диалог, эмпатию и более глубокое понимание богатого культурного разнообразия нашей планеты. Присоединяйтесь к нам в путешествии, чтобы открывать, учиться и соединяться с культурами со всего мира.                    </p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase comfortaa-regular">Статьи</h5>
                    <ul class="list-unstyled mb-0">
                        <?php
                        foreach ($articles_query_result as $article) {
                            echo "<li><a href='article.php?id={$article['Id']}' class='text-dark'>{$article['Name']}</a></li>";
                        }
                        ?>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-0 comfortaa-bold">News</h5>
                    <ul class="list-unstyled">
                        <?php

                        foreach ($news_query_result as $news) {
                            echo "<li><a href='news.php?id={$news['Id']}' class='text-dark'>{$news['Name']}</a></li>";
                        }
                        ?>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-0 comfortaa-bold">Товары</h5>
                    <ul class="list-unstyled">
                        <?php
                        foreach ($products_query_result as $product) {
                            echo "<li><a href='product.php?id={$product['Id']}' class='text-dark'>{$product['Name']}</a></li>";
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-0 comfortaa-bold">Музеи</h5>
                    <ul class="list-unstyled">
                        <?php
                        foreach ($museums_query_result as $museum) {
                            echo "<li><a href='museum.php?id={$museum['Id']}' class='text-dark'>{$museum['Name']}</a></li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.08);">
            © 2025 Copyright:
            <a class="text-dark" href="/cult_conn">Culture Connect</a>
        </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $(".alert").hide().fadeIn(500);

    setTimeout(function() {
        $(".alert").fadeOut(500, function() {
            $(this).slideUp(2500, function() {
                $(this).remove(); 
            });
        });
    }, 5000);
});
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script> 
<footer>

</footer>
</body>