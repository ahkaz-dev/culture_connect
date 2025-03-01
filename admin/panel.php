<?php include "../include/header.php"; ?>

<?php

$query = $pdo->prepare("SELECT count(*) FROM museums");
$query->execute();
$mesuems_query_result = $query->fetchColumn();

$query = $pdo->prepare("SELECT count(*) FROM news");
$query->execute();
$news_query_result = $query->fetchColumn();

$query = $pdo->prepare("SELECT count(*) FROM articles");
$query->execute();
$article_query_result = $query->fetchColumn();

$query = $pdo->prepare("SELECT count(*) FROM product");
$query->execute();
$product_query_result = $query->fetchColumn();

$query = $pdo->prepare("SELECT count(*) FROM users");
$query->execute();
$users_query_result = $query->fetchColumn();

?>
<?php 
if (isset($_SESSION["log-session"]) && isset($_SESSION['log-session-data'])): 
    if ($_SESSION['log-session-data']["Admin"]):
?>
<style>
        .card-img-overlay {
            position: absolute;
            top: 35%;
            left: 0;
            transform: translateY(-50%);
            color: white;
            font-weight: 500;
            border-radius: 5px 0 0 5px;
        }
        .card img {
            width: 100%;
            height: 239px;
            border-radius: 5px 5px 0 0;
            object-fit: none;
        }
</style>
<title>Админ-панель</title>

<div class="container mt-5">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <!-- Карточка Музеи -->
            <div class="col">
                <div class="card h-100">
                    <div class="position-relative">
                        <img src="./static/png/card-museum.png" loading="lazy" class="card-img-top" alt="Музеи">
                        <div class="card-img-overlay">Museums <br>Число записей [<?= (empty($mesuems_query_result)) ? "0" : $mesuems_query_result ?>] </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Музеи</h5>
                        <p class="card-text">Описание категории Музеи. Здесь вы можете найти информацию о различных музеях.</p>
                        <a href="/cult_conn/admin/museum.php" class="btn btn-primary">Подробнее</a>
                    </div>
                </div>
            </div>
            <!-- Карточка Статьи -->
            <div class="col">
                <div class="card h-100">
                    <div class="position-relative">
                        <img src="./static/png/card-acrticle.png" loading="lazy" class="card-img-top" alt="Статьи">
                        <div class="card-img-overlay">Статьи <br>Число записей [<?= (empty($article_query_result)) ? "0" : $article_query_result ?>]</div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Статьи</h5>
                        <p class="card-text">Описание категории Статьи. Здесь вы можете найти интересные статьи на разные темы.</p>
                        <a href="#" class="btn btn-primary">Подробнее</a>
                    </div>
                </div>
            </div>
            <!-- Карточка Новости -->
            <div class="col">
                <div class="card h-100">
                    <div class="position-relative">
                        <img src="./static/png/card-news.png" loading="lazy" class="card-img-top" alt="Новости">
                        <div class="card-img-overlay">News <br>Число записей [<?= (empty($news_query_result)) ? "0" : $news_query_result ?>]</div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Новости</h5>
                        <p class="card-text">Описание категории Новости. Здесь вы можете найти последние новости.</p>
                        <a href="#" class="btn btn-primary">Подробнее</a>
                    </div>
                </div>
            </div>
            <!-- Карточка Пользователи -->
            <div class="col">
                <div class="card h-100">
                    <div class="position-relative">
                        <img src="./static/png/card-users.png" loading="lazy" class="card-img-top" alt="Пользователи">
                        <div class="card-img-overlay">Пользователи <br>Число записей [<?= (empty($users_query_result)) ? "0" : $users_query_result ?>]</div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Пользователи</h5>
                        <p class="card-text">Описание категории Пользователи. Здесь вы можете найти информацию о пользователях.</p>
                        <a href="#" class="btn btn-primary">Подробнее</a>
                    </div>
                </div>
            </div>
            <!-- Карточка Товары -->
            <div class="col">
                <div class="card h-100">
                    <div class="position-relative">
                        <img src="./static/png/card-product.png" loading="lazy" class="card-img-top" alt="Товары">
                        <div class="card-img-overlay">Товары <br>Число записей [<?= (empty($product_query_result)) ? "0" : $product_query_result ?>]</div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Товары</h5>
                        <p class="card-text">Описание категории Товары. Здесь вы можете найти информацию о различных товарах.</p>
                        <a href="#" class="btn btn-primary">Подробнее</a>
                    </div>
                </div>
            </div>
        </div>
</div>
    <?php else: ?>
        <div class="container mt-5">
                <?php include "../error/404.php"; ?> 
        </div>
    <?php
    endif;
    ?>
<?php else: ?>
    <div class="container mt-5">
            <?php include "../error/404.php"; ?> 
    </div>
<?php
endif;
?>

<?php include "../include/footer.php"; ?>