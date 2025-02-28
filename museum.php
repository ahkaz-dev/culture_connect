<?php include "include/header.php"; ?>
<?php 
$query_museums = $pdo->prepare("SELECT * FROM museums");
$query_museums->execute();
$mesuems_query_result = $query_museums->fetchAll(PDO::FETCH_ASSOC);
?>
<title>Culture Connect | Музеи</title>
<style>
    .card img {
        width: 100%;
        height: 239px;
        border-radius: 5px 5px 0 0;
        object-fit: none;
    }
</style>
<body class="bg-light">
    <div class="container py-5">
        <?php if ($mesuems_query_result): ?>
            <div class="row justify-content-center">
                <?php foreach ($mesuems_query_result as $row): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm rounded-3">
                            <div class="position-relative">
                                <img src="cult_conn/uploads/<?= htmlspecialchars($row['Image_path']) ?>" class="image-preview img-fluid" alt="Музей">
                            </div>
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold"><?= htmlspecialchars($row["Name"]) ?></h5>
                                <p class="card-text text-muted"><?= htmlspecialchars($row['Short_desc']) ?></p>
                                <p class="card-text"><?= nl2br(htmlspecialchars($row['Full_desc'])) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-muted text-center">Мы ничего не знаем про музеи (</p>
        <?php endif; ?>
    </div>
</body>

<?php include "include/footer.php"; ?>