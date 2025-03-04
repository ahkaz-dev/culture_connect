<?php include "../../include/header.php"; ?>
<?php include "../../include/message.php"; ?>

<?php 

$Id = (isset($_GET['id'])) ? $_GET['id'] : 0;
$query = $pdo->prepare("SELECT * FROM users WHERE Id =:Id");
$query->execute(['Id' => $Id]);
$user_query_result = $query->fetch(PDO::FETCH_ASSOC);

?>    
<?php 
if (isset($_SESSION["log-session"]) && isset($_SESSION['log-session-data'])): 
    if ($_SESSION['log-session-data']["Admin"]):
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
            $stmt = $pdo->prepare("DELETE FROM users WHERE Id = :Id");
            $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                $_SESSION["log-mess-warn"] = "Запись удалена";
                echo '<script type="text/javascript">';
                echo 'window.location.href = "http://localhost/cult_conn/admin/article.php";';
                echo '</script>';
            } 
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
            $id = $user_query_result["Id"];
            $login = $_POST['login'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
            $email = $_POST['email'];

            if ($user_query_result["Id"] == $_SESSION['log-session-data']['Id']):
                $admin = $user_query_result["Admin"];
                $editor = $user_query_result["Editor"];
            else:
                $admin = $_POST['admin'] ?  1: null;
                $editor = $_POST['editor'] ?  1: null;
            endif;
        
            $stmt = $pdo->prepare("UPDATE users SET Login = ?, Password = ?, Email = ?, Admin = ?, Editor = ? WHERE Id = ?");
            if ($stmt->execute([$login, $password, $email, $admin, $editor, $id])) {
                $_SESSION["log-mess-s"] = "Запись обновлена";
                echo "<script>location.href = 'https://localhost/cult_conn/admin/user.php';</script>";
            } else {
                echo "<script>alert('Ошибка при обновлении данных пользователя.');</script>";
            }
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
            $login = $_POST['name'];
            $password = $_POST['short_desc'];
            $email = $_POST['full_desc'];
        
            $stmt = $pdo->prepare("INSERT INTO users SET Login = ?, Password = ?, Email = ?, Admin = ?, Editor = ?");
            if ($stmt->execute([$login, $password, $email, $admin, $editor, $footer_desc])) {
                $_SESSION["log-mess-s"] = "Запись сохранена";
                echo "<script>location.href = 'https://localhost/cult_conn/admin/user.php';</script>";
            } else {
                echo "<script>alert('Ошибка при добавлении данных пользователя.');</script>";
            }
        }
?>
<div class="container mt-5">
        <?php if ($user_query_result): ?>
            <title>Пользователь: <?= $user_query_result["Login"] ?></title>
            <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="form-container">
                    <div class="col-md-8">
                            <div class="mb-3">
                                <label for="id" class="form-label">ID</label>
                                <input type="text" class="form-control" id="id" disabled name="id" value="<?= htmlspecialchars($user_query_result["Id"]) ?>" readonly>
                            </div>
                            <?php if ($user_query_result["Id"] == $_SESSION['log-session-data']['Id']): ?>
                                <div class="mb-3" style="pointer-events: none;opacity: 0.6;">
                                    <label for="id" class="form-label">Роль доступа</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="admin" name="admin" <?php echo ($user_query_result["Admin"]) ? 'checked' : ''; ?> >
                                        <label class="form-check-label" for="admin">
                                            Админ
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="editor" <?php echo ($user_query_result["Editor"]) ? 'checked' : ''; ?> name="editor">
                                        <label class="form-check-label" for="admin">
                                            Редактор
                                        </label>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="mb-3">
                                    <label for="id" class="form-label">Роль доступа</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="admin" id="admin" name="admin" <?php echo ($user_query_result["Admin"]) ? 'checked' : ''; ?> >
                                        <label class="form-check-label" for="admin">
                                            Админ
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="editor" id="editor" <?php echo ($user_query_result["Editor"]) ? 'checked' : ''; ?> name="editor">
                                        <label class="form-check-label" for="admin">
                                            Редактор
                                        </label>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="mb-3">
                                <label for="login" class="form-label">Логин пользователя</label>
                                <input type="text" class="form-control" id="login" name="login" value="<?= htmlspecialchars($user_query_result["Login"]) ?>" maxlength="25" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Текущий пароль <span class="small">(хешированом виде)</span></label>
                                <input class="form-control" id="password" name="password" maxlength="25" disabled required value="<?= substr(htmlspecialchars($user_query_result["Password"]), 0, 6)?>. . ." ?>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Новый пароль</label>
                                <input class="form-control" id="password" name="password" maxlength="25" ?>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Электронная почта</label>
                                <input type="email" class="form-control" name="email" id="email" maxlength="320" required value="<?= htmlspecialchars($user_query_result["Email"]) ?>">
                            </div>
                            <button type="submit" class="btn btn-primary" name="update">Сохранить</button>
                            <?php if (!($user_query_result["Id"] == $_SESSION['log-session-data']['Id'])): ?>
                                <form method="post">
                                    <button class="btn btn-danger" name="delete">Удалить</button>
                                </form>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        <?php elseif($user_query_result == 0): ?>
            <title>Создать нового пользователя</title>
            <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="form-container">
                    <div class="col-md-8">
                            <div class="mb-3">
                                <label for="name" class="form-label">Название</label>
                                <input type="text" class="form-control" id="name" name="name" maxlength="55" required>
                            </div>
                            <div class="mb-3">
                                <label for="short_desc" class="form-label">Краткое описание</label>
                                <textarea class="form-control" id="short_desc" name="short_desc" maxlength="150" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="full_desc" class="form-label">Полное описание</label>
                                <textarea class="form-control" id="full_desc" name="full_desc" maxlength="320" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="footer_desc" class="form-label">Подвал (конец) новости</label>
                                <textarea class="form-control" id="footer_desc" name="footer_desc" maxlength="150" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Дата</label>
                                <div class="col-lg-3 col-sm-6">
                                    <input id="date" class="form-control" type="date" disabled required format="yyyy-mm-dd" value="<?= date("Y-m-d") ?>"/>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" name="save">Сохранить</button>
                            <button class="btn btn-second" type="reset">Очистить</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <p class="text-muted">Данного юзера не существует :(</p>
        <?php endif; ?>
    <?php else: ?>
            <div class="container mt-5">
                <?php include "./../../error/404.php"; ?> 
            </div>
    <?php endif; ?>
</div>
</div>
<?php else: ?>
        <div class="container mt-5">
                <?php include "./../../error/404.php"; ?> 
        </div>
    <?php
    endif; ?>
<?php include "../../include/footer.php"; ?>