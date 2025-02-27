<?php include "include/header.php"; ?>
<?php 
$query_museums = $pdo->prepare("SELECT * FROM product");
$query_museums->execute();
$products_query_result = $query_museums->fetchAll(PDO::FETCH_ASSOC);
?>
<title>Culture Connect | Товары</title>

<body class="bg-light">
    <div class="container py-5">
        <?php if ($products_query_result): ?>
            <div class="row justify-content-center">
                <?php foreach ($products_query_result as $row): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm rounded-3 d-flex flex-column">
                            <div class="card-body text-center flex-grow-1">
                                <h5 class="card-title fw-bold"><?= htmlspecialchars($row["Name"]) ?></h5>
                                <p class="card-text text-muted"><?= htmlspecialchars($row['Short_desc']) ?></p>
                                <p class="card-text"><?= nl2br(htmlspecialchars($row['Full_desc'])) ?></p>
                                <p class="card-text fw-bold text-success">Цена: <?= htmlspecialchars($row['Price']) ?> ₽</p>
                                <p>
                                    <?php if ($row['Available'] == 'Yes'): ?>
                                        <span class="badge bg-success">В наличии</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Нет в наличии</span>
                                    <?php endif; ?>
                                </p>
                            </div>
                            <div class="card-footer bg-white border-0 text-center">
                                <a href="dynamic_pages/products.php?id=<?= urlencode($row['Id']) ?>" class="btn btn-primary w-100">Узнать подробнее</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-muted text-center">Мы ничего не продаем (</p>
        <?php endif; ?>
    </div>
</body>


<?php include "include/footer.php"; ?>