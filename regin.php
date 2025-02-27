<?php include "include/header.php"; ?>
<?php include "include/message.php"; ?>

<?php

if (isset($_POST['register-button'])) {
    if (!empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        $login = trim($_POST['login']);
        $email = trim($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

        $stmt = $pdo->prepare("SELECT * FROM users WHERE Login = :login OR Email = :email");
        $stmt->execute(['login' => $login, 'email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($user['Login'] === $login) {
                $_SESSION['log-mess-e'] = "Этот логин уже занят";
            } elseif ($user['Email'] === $email) {
                $_SESSION['log-mess-e'] = "Этот email уже зарегистрирован";
            }
        } else {
            $stmt = $pdo->prepare("INSERT INTO users (Login, Password, Email) VALUES (:login, :password, :email)");
            if ($stmt->execute(['login' => $login, 'password' => $password, 'email' => $email])) {
                $_SESSION['log-mess-s'] = "Регистрация успешна! Вы вошли в свой аккаунт";
                $_SESSION["log-session"] = true;
                
                $stmt = $pdo->prepare("SELECT * FROM users WHERE Login = :login");
                $stmt->execute(['login' => $login]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['log-session-data'] = $user;

                header('Location: index.php');
                exit();
            } else {
                $_SESSION['log-mess-e'] = "Ошибка регистрации, попробуйте позже.";
            }
        }
    } else {
        $_SESSION['log-mess-e'] = "Заполните все поля!";
    }

    header('Location: regin.php');
    exit();
}
?>

<title>Регистрация аккаунта</title>

<div class="container mt-5">
    <h2>Регистрация</h2>
    <form action="regin.php" method="POST">
        <div class="mb-3">
            <label for="login" class="form-label">Логин</label>
            <input type="text" class="form-control" id="login" name="login" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" name="register-button" class="btn btn-primary">Зарегистрироваться</button>
    </form>
</div>

<?php include "include/footer.php"; ?>