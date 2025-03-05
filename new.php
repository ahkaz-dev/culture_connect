<?php include "include/header.php"; ?>
<?php 
$query_museums = $pdo->prepare("SELECT * FROM news");
$query_museums->execute();
$news_query_result = $query_museums->fetchAll(PDO::FETCH_ASSOC);
?>
<title>Culture Connect | Новости</title>

<body class="bg-light">
    <div class="container py-5">
        <?php if ($news_query_result): ?>
            <div class="row justify-content-center">
                <?php foreach ($news_query_result as $row): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm rounded-3">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold"><?= htmlspecialchars($row["Name"]) ?></h5>
                                <p class="card-text text-muted"><?= htmlspecialchars($row['Short_desc']) ?></p>
                                <a class="btn btn-primary" href="/cult_conn/dynamic_pages/news.php?id=<?= htmlspecialchars($row["Id"])?>">Узнать подробнее</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-muted text-center">У нас нет новостей (</p>
        <?php endif; ?>
    </div>
</body>

<?php include "include/footer.php"; ?>