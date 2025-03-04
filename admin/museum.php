<?php include "../include/header.php"; ?>
<?php include "../include/message.php"; ?>

<title>Админ-панель | Музеи</title>
<?php 
if (isset($_SESSION["log-session"]) && isset($_SESSION['log-session-data'])): 
    if ($_SESSION['log-session-data']["Admin"]):
        $query = $pdo->prepare("SELECT museums.*, users.login FROM museums JOIN users ON museums.editor = users.id ORDER BY museums.id;");
        $query->execute();
        $mesuems_query_result = $query->fetchAll(PDO::FETCH_ASSOC);
?>
    <div class="container mt-5">
        <h2 class="mb-4">Информация о музеях</h2>
        <div class="mb-3">
            <form method="post">
                <a class="btn btn-primary" href="/cult_conn/admin/dynamic/museums.php">Добавить запись</a>
            </form>
        </div>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Краткое описание</th>
                    <th>Полное описание</th>
                    <th>Запись создал</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($mesuems_query_result)): ?>
                    echo "<tr>";
                <?php else: ?>
                    <?php foreach ($mesuems_query_result as $museum) { ?>
                        <tr>
                            
                            <th scope="row"><?= htmlspecialchars($museum["Id"]) ?></th>
                            <td><?= htmlspecialchars($museum["Name"]) ?></td>
                            <td><?= htmlspecialchars($museum["Short_desc"]) ?></td>
                            <td><?= htmlspecialchars($museum["Full_desc"]) ?></td>
                            <td><?= htmlspecialchars($museum["login"]) ?></td>
                            <td><a href="/cult_conn/admin/dynamic/museums.php?id=<?= htmlspecialchars($museum["Id"])?>">Редактировать</a></td>
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