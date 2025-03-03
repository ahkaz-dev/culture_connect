<?php include "../include/header.php"; ?>
<?php include "../include/message.php"; ?>

<title>Админ-панель | Новости</title>
<?php 
if (isset($_SESSION["log-session"]) && isset($_SESSION['log-session-data'])): 
    if ($_SESSION['log-session-data']["Admin"]):
        $query = $pdo->prepare("SELECT * FROM news");
        $query->execute();
        $new_query_result = $query->fetchAll(PDO::FETCH_ASSOC);
?>
    <div class="container mt-5">
        <h2 class="mb-4">Информация о новостях</h2>
        <div class="mb-3">
            <form method="post">
                <a class="btn btn-primary" href="/cult_conn/admin/dynamic/news.php">Добавить запись</a>
            </form>
        </div>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Краткое описание</th>
                    <th>Полное описание</th>
                    <th>Конец новости</th>
                    <th>Дата статьи</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($new_query_result)): ?>
                    echo "<tr>";
                <?php else: ?>
                    <?php foreach ($new_query_result as $new) { ?>
                        <tr>
                            <th scope="row"><?= htmlspecialchars($new["Id"]) ?></th>
                            <td><?= htmlspecialchars($new["Name"]) ?></td>
                            <td><?= htmlspecialchars($new["Short_desc"]) ?></td>
                            <td><?= htmlspecialchars($new["Full_desc"]) ?></td>
                            <td><?= htmlspecialchars($new["Footer_desc"]) ?></td>
                            <td><?= htmlspecialchars($new["Date"]) ?></td>

                            <td><a href="/cult_conn/admin/dynamic/news.php?id=<?= htmlspecialchars($new["Id"])?>">Редактировать</a></td>
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