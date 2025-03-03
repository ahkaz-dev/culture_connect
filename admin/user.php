<?php include "../include/header.php"; ?>
<?php include "../include/message.php"; ?>

<title>Админ-панель | Пользователи</title>
<style>
    .login-cell {
        position: relative;
    }

    .role-icon {
        cursor: default;
        position: absolute;
        right: 0;
        top: 0;
        font-size: 1.2em; 
        opacity: 0.72;
    }

</style>
<?php 
if (isset($_SESSION["log-session"]) && isset($_SESSION['log-session-data'])): 
    if ($_SESSION['log-session-data']["Admin"]):
        $query = $pdo->prepare("SELECT * FROM users");
        $query->execute();
        $user_query_result = $query->fetchAll(PDO::FETCH_ASSOC);
?>
    <div class="container mt-5">
        <h2 class="mb-4">Информация о пользователях</h2>
        <div class="mb-3">
            <form method="post">
                <a class="btn btn-primary" href="/cult_conn/admin/dynamic/users.php">Добавить запись</a>
            </form>
        </div>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Логин</th>
                    <th>Почта</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($user_query_result)): ?>
                    echo "<tr>";
                <?php else: ?>
                    <?php foreach ($user_query_result as $user) { ?>
                        <?php if ($user["Admin"]): ?>
                            <tr class="admin">
                        <?php elseif ($user["Editor"]): ?>
                            <tr class="editor">
                        <?php else: ?>
                            <tr>
                        <?php endif; ?>
                        <th scope="row"><?= htmlspecialchars($user["Id"]) ?></th>
                        <td class="login-cell">
                            <?= htmlspecialchars($user["Login"]) ?>
                            <?php if ($user["Admin"] || $user["Editor"]): ?>
                                <span class="role-icon" title="<?= $user["Admin"] ? 'Админ' : 'Редактор' ?>">
                                    <?= $user["Admin"] ? '⭐' : '✏️' ?>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($user["Email"]) ?></td>
                        <td><a href="/cult_conn/admin/dynamic/users.php?id=<?= htmlspecialchars($user["Id"])?>">Редактировать</a></td>
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