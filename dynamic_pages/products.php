<?php include "../include/header.php"; ?>
<?php 
$Id = $_GET['id'];
$query_product = $pdo->prepare("SELECT * FROM product WHERE Id=:Id");
$query_product->execute(['Id' => $Id]);
$product_query_result = $query_product->fetch(PDO::FETCH_ASSOC);
?>
<title>Товар: <?= $product_query_result["Name"] ?></title>
<body>
<div class="container py-5">
    <?php if ($product_query_result): ?>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white fw-bold text-center fs-4">
                        <?= htmlspecialchars($product_query_result["Name"]) ?>
                    </div>
                    <div class="card-body">
                        <p class="text-muted"><i class="bi bi-calendar"></i> Дата добавления: <?= htmlspecialchars($product_query_result['Date']) ?></p>
                        <p class="fw-semibold"><?= htmlspecialchars($product_query_result['Short_desc']) ?></p>
                        <hr>
                        <p><?= nl2br(htmlspecialchars($product_query_result['Full_desc'])) ?></p>
                        <p class="fw-bold text-success fs-5">Цена: <?= htmlspecialchars($product_query_result['Price']) ?> ₽</p>
                        <p>
                            <?php if ($product_query_result['Available'] == 'Yes'): ?>
                                <span class="badge bg-success">В наличии</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Нет в наличии</span>
                            <?php endif; ?>
                        </p>
                    </div>
                    <div class="card-footer bg-light text-end text-muted">
                        <i class="bi bi-person"></i> Продавец: <?= htmlspecialchars($product_query_result['login']) ?>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="product.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Назад к каталогу</a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center" role="alert">
            Этот товар не найден :(
        </div>
        <div class="text-center mt-4">
                    <a href="product.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Назад к каталогу</a>
        </div>
    <?php endif; ?>
</div>

</body>
<?php include "../include/footer.php"; ?>