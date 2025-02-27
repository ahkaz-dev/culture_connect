<?php 
session_start();
include __DIR__ . '/../db/connect.php';

$query_artl = $pdo->prepare("SELECT Name, Id FROM articles");
$query_artl->execute();
$articles_query_result = $query_artl->fetchAll(PDO::FETCH_ASSOC);
$lastItem_articles = end($articles_query_result);


$query_news = $pdo->prepare("SELECT Name, Id FROM news");
$query_news->execute();
$news_query_result = $query_news->fetchAll(PDO::FETCH_ASSOC);
$lastItem_news = end($news_query_result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <base href="/cult_conn/">
</head>
<header class="top-bar">
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/cult_conn">Логотип</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Музеи</a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" href="./museum.php">Музеи</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Статьи
            </a>
            <ul class="dropdown-menu">
            <?php if(empty($articles_query_result)): ?>
                <li><a class="dropdown-item disabled" href="#">Статьи отсутствуют</a></li>
            <?php else: ?>
                <?php foreach ($articles_query_result as $row): ?>
                        <li><a class="dropdown-item" href="dynamic_pages/articles.php?id=<?= $row['Id'] ?>"><?= htmlspecialchars($row['Name']) ?></a></li>
                        <?php if ($row !== $lastItem_articles): // Добавляем разделитель только если это НЕ последний элемент ?>
                            <li><hr class="dropdown-divider"></li>
                        <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./product.php">Товары</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Новости
            </a>
            <ul class="dropdown-menu">
            <?php if(empty($news_query_result)): ?>
                <li><a class="dropdown-item disabled" href="#">Новостей нет</a></li>
            <?php else: ?>
                <?php foreach ($news_query_result as $row): ?>
                        <li><a class="dropdown-item" href="dynamic_pages/news.php?id=<?= $row['Id'] ?>"><?= htmlspecialchars($row['Name']) ?></a></li>
                        <?php if ($row !== $lastItem_news): // Добавляем разделитель только если это НЕ последний элемент ?>
                            <li><hr class="dropdown-divider"></li>
                        <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            </ul>
        </li>
        </ul>
        <div class="navbar-nav d-flex me-5" role="search">
            <?php if (isset($_SESSION["log-session"])): ?>
                <?php if (isset($_SESSION['log-session-data'])): ?>
                    <?php if ($_SESSION['log-session-data']["Admin"]): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Админ-панель</a>
                        </li>
                    <?php elseif ($_SESSION['log-session-data']["Editor"]): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Дашборд</a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <img src="/cult_conn/static/svg/user-circle.svg" alt="Мой аккаунт" width="30" height="30">
                </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Настройки</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="include/logout.php">Выход</a></li>
                    </ul>
            </li>
            <?php else: ?>
            <li class="nav-item">
                <a class="nav-link" href="./login.php">Вход</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./regin.php">Регистрация</a>
            </li>
            <?php endif; ?>
        </div>
    </div>
  </div>
</nav>
</header>
<body>
    
