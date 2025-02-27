<?php include "../include/header.php"; ?>
<?php 
$Id = $_GET['id'];
$query_news = $pdo->prepare("SELECT * FROM news WHERE Id=:Id");
$query_news->execute(['Id' => $Id]);
$news_query_result = $query_news->fetch(PDO::FETCH_ASSOC);
?>
<title>Новость: <?= $news_query_result["Name"] ?></title>
<body>
<div class="container mt-5">
        <?php if ($news_query_result): ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($news_query_result["Name"]) ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($news_query_result['Date']) ?></h6>
                    <p class="card-text"><?= htmlspecialchars($news_query_result['Short_desc']) ?></p>
                    <p class="card-text"><?= htmlspecialchars($news_query_result['Full_desc']) ?></p>
                    <p class="card-text text-muted"><?= htmlspecialchars($news_query_result['Footer_desc']) ?></p>
                </div>
            </div>
        <?php else: ?>
            <p class="text-muted">Данной новости не существует :(</p>
        <?php endif; ?>
    </div>
</body>
<?php include "../include/footer.php"; ?>