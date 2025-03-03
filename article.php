<?php include "include/header.php"; ?>
<?php 
$query_museums = $pdo->prepare("SELECT * FROM articles");
$query_museums->execute();
$articles_query_result = $query_museums->fetchAll(PDO::FETCH_ASSOC);
?>
<title>Culture Connect | Статьи</title>

<body class="bg-light">
    <div class="container py-5">
        <?php if ($articles_query_result): ?>
            <div class="row justify-content-center">
                <?php foreach ($articles_query_result as $row): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm rounded-3">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold"><?= htmlspecialchars($row["Name"]) ?></h5>
                                <p class="card-text text-muted"><?= htmlspecialchars($row['Short_desc']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-muted text-center">У нас нет статей (</p>
        <?php endif; ?>
    </div>
</body>

<?php include "include/footer.php"; ?>