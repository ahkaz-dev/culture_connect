<?php include "include/header.php"; ?>
<?php include "include/message.php"; ?>

<?php 

if (isset($_POST['login-button'])) {
    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        $login = $_POST['login'];
        $password = $_POST['password']; 
        
        $stmt = $pdo->prepare("SELECT * FROM users WHERE Login = :login");
        $stmt->execute(['login' => $login]);
        $user = $stmt->fetch();

        if ($user) {
            if (password_verify($password, $user['Password'])) {
                $_SESSION['log-session-data'] = $user;
                $_SESSION["log-session"] = true;

                $_SESSION["log-mess-s"] = "Вы вошли в аккаунт";
                echo '<script type="text/javascript">';
                echo 'window.location.href = "http://localhost/cult_conn/";';
                echo '</script>';
            } else {
                $_SESSION['log-mess-e'] = "Ошибка ввода";
            }
        } else {
            $_SESSION['log-mess-e'] = "Пользователь не найден";
        }
    } else {
        $_SESSION['log-mess-e'] = "Заполните все поля";
    }
    echo '<script type="text/javascript">';
    echo 'window.location.href = "http://localhost/cult_conn/login.php";';
    echo '</script>';
}



?>
<title>Авторизация</title>

<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="card rounded-4 p-4" style="max-width: 400px; width: 100%;">
        <div class="card-body">
            <h3 class="text-center mb-4">Войти в аккаунт</h3>
            <form method="post">
                <div class="mb-3">
                    <label for="inputLogin" class="form-label">Логин</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" pattern=".+" class="form-control" id="inputLogin" name="login" placeholder="Введите логин" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Пароль</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" pattern=".+" class="form-control" id="inputPassword" name="password" placeholder="Введите пароль" required>
                    </div>
                </div>
                <button type="submit" name="login-button" class="btn btn-success w-100 btn-lg">Войти</button>
                <div class="text-center mt-3">
                    <a href="regin.php" class="btn btn-secondary w-100">Регистрация</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "include/footer.php"; ?>