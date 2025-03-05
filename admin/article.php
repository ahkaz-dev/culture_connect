<?php include "../include/header.php"; ?>
<?php include "../include/message.php"; ?>

<title>Админ-панель | Статьи</title>
<?php 
if (isset($_SESSION["log-session"]) && isset($_SESSION['log-session-data'])): 
    if ($_SESSION['log-session-data']["Admin"]):
        $query = $pdo->prepare("SELECT articles.*, users.login FROM articles JOIN users ON articles.editor = users.id ORDER BY articles.id");
        $query->execute();
        $articles_query_result = $query->fetchAll(PDO::FETCH_ASSOC);
?>
    <div class="container mt-5">
        <h2 class="mb-4">Информация о статьях</h2>
        <div class="mb-3">
            <form method="post">
                <a class="btn btn-primary" href="/cult_conn/admin/dynamic/articles.php">Добавить запись</a>
            </form>
        </div>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Краткое описание</th>
                    <th>Полное описание</th>
                    <th>Дата статьи</th>
                    <th>Автор статьи</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($articles_query_result)): ?>
                <?php else: ?>
                    <?php foreach ($articles_query_result as $article) { ?>
                        <tr>
                            <th scope="row"><?= htmlspecialchars($article["Id"]) ?></th>
                            <td><?= htmlspecialchars($article["Name"]) ?></td>
                            <td><?= htmlspecialchars($article["Short_desc"]) ?></td>
                            <td><?= htmlspecialchars($article["Full_desc"]) ?></td>
                            <td><?= htmlspecialchars($article["Date"]) ?></td>
                            <td><?= htmlspecialchars($article["login"]) ?></td>

                            <td><a href="/cult_conn/admin/dynamic/articles.php?id=<?= htmlspecialchars($article["Id"])?>">Редактировать</a></td>
                        </tr>
                    <?php }
                endif; ?>
            </tbody>
        </table>
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