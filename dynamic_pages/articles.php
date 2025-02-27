<?php include "../include/header.php"; ?>
<?php 
$Id = $_GET['id'];
$query_artl = $pdo->prepare("SELECT articles.*, users.login FROM articles JOIN users ON articles.editor = users.id WHERE articles.Id=:Id");
$query_artl->execute(['Id' => $Id]);
$articles_query_result = $query_artl->fetch(PDO::FETCH_ASSOC);
?>
<title>Статья: <?= $articles_query_result["Name"] ?></title>
<body>
<div class="container mt-5">
    <?php if ($articles_query_result): ?>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white fw-bold">
                        <?= htmlspecialchars($articles_query_result["Name"]) ?>
                    </div>
                    <div class="card-body">
                        <p class="text-muted"><i class="bi bi-calendar"></i> <?= htmlspecialchars($articles_query_result['Date']) ?></p>
                        <p class="fw-semibold"> <?= htmlspecialchars($articles_query_result['Short_desc']) ?> </p>
                        <hr>
                        <p> <?= nl2br(htmlspecialchars($articles_query_result['Full_desc'])) ?> </p>
                    </div>
                    <div class="card-footer bg-light text-end text-muted">
                        <i class="bi bi-person"></i>---- <?= htmlspecialchars($articles_query_result['login']) ?>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center" role="alert">
            Данной статьи не существует :(
        </div>
    <?php endif; ?>
</div>
</body>
<?php include "../include/footer.php"; ?>