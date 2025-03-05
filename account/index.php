<?php include "../include/header.php"; ?>
<?php include "../include/message.php"; ?>

<title>Настройки аккаунта</title>

<?php 

if (isset($_SESSION["log-session"]) && isset($_SESSION['log-session-data'])): 
    $stmt = $pdo->prepare("SELECT * FROM users WHERE Id = :Id");
    $id = $_SESSION['log-session-data']["Id"];
    $stmt->execute(['Id' => $id]);
    $user = $stmt->fetch();
    $id_u = $user["Id"];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
        $image_path = $user["Image_path"];
        $id_u = $user["Id"];
        $pdo->query('SET foreign_key_checks = 0');

        if ($image_path) {
            if (unlink($image_path)) {
                $stmt = $pdo->prepare("DELETE FROM users WHERE Id = ?");
                $stmt->bindParam(1, $id_u, PDO::PARAM_INT);
            }
        } else {
            $stmt = $pdo->prepare("DELETE FROM users WHERE Id = ?");
            $stmt->bindParam(1, $id_u, PDO::PARAM_INT);
        }
         

        if ($stmt->execute()) {
            try {
                $pdo->beginTransaction();

                $tables = ['Museums', 'Articles', 'News', 'Product'];

                foreach ($tables as $table) {
                    $stmt = $pdo->prepare("DELETE FROM $table WHERE Editor = ?");
                    $stmt->bindParam(1, $id_u, PDO::PARAM_INT);
                    $stmt->execute();
                }

                $stmt = $pdo->prepare("DELETE FROM users WHERE Id = ?");
                $stmt->bindParam(1, $id_u, PDO::PARAM_INT);
                $stmt->execute();

                $pdo->commit();
            } catch (\Throwable $th) {
            }

            echo '<script type="text/javascript">';
            echo 'window.location.href = "http://localhost/cult_conn/include/logout.php";';
            echo '</script>';
        } 
        $pdo->query('SET foreign_key_checks = 1');

    } 

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_data'])) {
        $id = $user["Id"];
        $login = $_POST['login'];
        $email = $_POST['email'];

        $temp_password = $_POST['new_password'];
        $password = $_POST['confirm_password'];
        if ($temp_password != $password) {
            $_SESSION["log-mess-e"] = "Пароли не совпадают";
            echo "<script>location.href = 'https://localhost/cult_conn/account/';</script>";
        } else {
            $password = password_hash($_POST['confirm_password'], PASSWORD_DEFAULT); 
        }   
    
        if (isset($_FILES['image'])) {
        $image_path = '../uploads/users/' . basename($_FILES['image']['name']);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                $stmt = $pdo->prepare("UPDATE users SET Image_path = ? WHERE Id = ?");
                if ($stmt->execute([$image_path, $id])) {
                    echo "<script>alert('Изображение успешно сохранено!');</script>";
                } else {
                    echo "<script>alert('Ошибка при сохранении изображения в базе данных.');</script>";
                }
            }
        } else {
            echo "<script>alert('Ошибка');</script>";
        } 
    
        $stmt = $pdo->prepare("UPDATE users SET Login = ?, Password = ?, Email = ? WHERE Id = ?");
        if ($stmt->execute([$login, $password, $email, $id])) {
            $_SESSION["log-mess-s"] = "Запись обновлена";
            echo "<script>location.href = 'https://localhost/cult_conn/account/';</script>";
        } else {
            echo "<script>alert('Ошибка при обновлении данных музея.');</script>";
        }
    }
?>

<form method="post" enctype="multipart/form-data">
<section style="background-color: #eee; padding: 5%;">
    <div class="row">
    <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <?php if ($user['Image_path']): ?>
                <img loading="lazy" src="/cult_conn/uploads/users/<?= htmlspecialchars(basename($user['Image_path'])) ?>" class="image-preview img-fluid" alt="Мой аватар">
            <?php elseif (isset($image_path)): ?>
                <img loading="lazy" src="/cult_conn/uploads/users/<?= htmlspecialchars(basename($image_path)) ?>" class="image-preview img-fluid" alt="Мой аватар">
            <?php else: ?>
                <img loading="lazy" src="/cult_conn/static/svg/user-circle.svg" class="image-preview img-fluid" height="200px" width="200px" alt="Мой аватар">
            <?php endif; ?>
            <h5 class="my-3"><?= $user['Login']?></h5>
            <p class="text-muted mb-3"><?= $user['Email'] ?></p>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="validateImageSize(this)">
            <br>
            <div class="d-flex justify-content-center mb-2" style="gap: 5%;">
                <button class="btn btn-primary" onclick="location.href='changepassword.php'">Сменить пароль</button>
                <form method="post" id="deleteForm">
                    <button class="btn btn-danger ms-1" onclick="javascript:return confirm('Удалить свой аккаунт?');"   name="delete">Удалить аккаунт</button>
                </form>
            </div>
          </div>
        </div>
      </div>
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header">Ваши данные</div>
                <div class="card-body">
                    <form method=POST>
                        <div class="mb-3">
                            <label class="small mb-1" for="login">Логин</label>
                            <input class="form-control" name="login" type="text" required placeholder="Ваш логин" value=<?= $user['Login'] ?>>
                        </div>
                        <div class="mb-3">
                                <label for="password" class="form-label">Текущий пароль <span class="small">(хешированом виде)</span></label>
                                <input class="form-control" id="password" name="password" maxlength="25" disabled required value="<?= substr($user["Password"], 0, 6)?>. . ." ?>
                        </div>
                        <div class="mb-3">
                                <label for="new_password" class="form-label">Новый пароль</label>
                                <input class="form-control" id="new_password" name="new_password" maxlength="25" ?>
                        </div>
                        <div class="mb-3">
                                <label for="confirm_password" class="form-label">Подтверждение пароля</label>
                                <input class="form-control" id="confirm_password" name="confirm_password" maxlength="25" ?>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="mb-3" style="pointer-events: none;opacity: 0.6;">
                                <label for="id" class="form-label">Роль доступа</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="admin" name="admin" <?php echo ($user["Admin"]) ? 'checked' : ''; ?> >
                                    <label class="form-check-label" for="admin">
                                        Админ
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="editor" <?php echo ($user["Editor"]) ? 'checked' : ''; ?> name="editor">
                                    <label class="form-check-label" for="admin">
                                        Редактор
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="email">Почта</label>
                            <input class="form-control" name="email" type="email" required placeholder="Ваша почта" value=<?= $user['Email'] ?>>
                        </div>
                        <button class="btn btn-primary" name='update_data' type="submit">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
</form>
<?php 
else: ?>
    <div class="container mt-5">
        <?php include "../error/404.php"; ?> 
    </div>
<?php endif; ?>
<script>
    function deleteMyAccount() {
        const confirmation = confirm("Вы уверены, что хотите удалить аккаунт?");
        const form = document.getElementById('deleteForm');
        if (confirmation) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_account';
            input.value = 'Удалить';
            form.appendChild(input);
        }
        form.submit();
    }
</script>
<script>
    function validateImageSize(input) {
        const file = input.files[0];
        if (file) {
            const maxSize = 2 * 1024 * 1024; // 2 MB
            if (file.size > maxSize) {
                alert('Изображение слишком большое. Максимальный размер: 2 МБ.');
                input.value = ''; // Очистка поля ввода
            }
        }
    }
</script>  
<?php include "../include/footer.php"; ?>