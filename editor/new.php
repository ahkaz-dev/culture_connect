<?php include "../include/header.php"; ?>
<?php include "../include/message.php"; ?>

<title>Админ-панель | Новости</title>
<?php 
if (isset($_SESSION["log-session"]) && isset($_SESSION['log-session-data'])): 
    if ($_SESSION['log-session-data']["Admin"] || $_SESSION['log-session-data']["Editor"]):
        $current_u_id = $_SESSION['log-session-data']["Id"];
        
        $query = $pdo->prepare("SELECT news.*, users.login as EditorLogin FROM news JOIN users ON news.editor = users.id WHERE news.editor = ? ORDER BY news.id;");
        $query->execute([$current_u_id]);
        $new_query_result = $query->fetchAll(PDO::FETCH_ASSOC);
?>
    <div class="container mt-5">
        <h2 class="mb-4">Информация о моих новостях</h2>
        <div class="mb-3">
            <form method="post">
                <a class="btn btn-primary" href="/cult_conn/editor/dynamic/news.php">Добавить запись</a>
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
                    <th>Автор новости</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($new_query_result)): ?>
                <?php else: ?>
                    <?php foreach ($new_query_result as $new) { ?>
                        <tr>
                            <th scope="row"><?= htmlspecialchars($new["Id"]) ?></th>
                            <td><?= htmlspecialchars($new["Name"]) ?></td>
                            <td><?= htmlspecialchars($new["Short_desc"]) ?></td>
                            <td><?= htmlspecialchars($new["Full_desc"]) ?></td>
                            <td><?= htmlspecialchars($new["Footer_desc"]) ?></td>
                            <td><?= htmlspecialchars($new["Date"]) ?></td>
                            <td><?= htmlspecialchars($new["EditorLogin"]) ?></td>

                            <td><a href="/cult_conn/editor/dynamic/news.php?id=<?= htmlspecialchars($new["Id"])?>">Редактировать</a></td>
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