<?php include "../../include/header.php"; ?>
<?php include "../../include/message.php"; ?>

<?php 

$Id = (isset($_GET['id'])) ? $_GET['id'] : 0;
$query = $pdo->prepare("SELECT * FROM news WHERE Id =:Id");
$query->execute(['Id' => $Id]);
$new_query_result = $query->fetch(PDO::FETCH_ASSOC);

?>    
<?php 
if (isset($_SESSION["log-session"]) && isset($_SESSION['log-session-data'])): 
    if ($_SESSION['log-session-data']["Admin"]):
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
            $stmt = $pdo->prepare("DELETE FROM news WHERE Id = :Id");
            $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                $_SESSION["log-mess-warn"] = "Запись удалена";
                echo '<script type="text/javascript">';
                echo 'window.location.href = "http://localhost/cult_conn/admin/new.php";';
                echo '</script>';
            } 
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
            $id = $new_query_result["Id"];
            $name = $_POST['name'];
            $short_desc = $_POST['short_desc'];
            $full_desc = $_POST['full_desc'];
            $footer_desc = $_POST['footer_desc'];
        
            $stmt = $pdo->prepare("UPDATE news SET Name = ?, Short_desc = ?, Full_desc = ?, Footer_desc = ? WHERE Id = ?");
            if ($stmt->execute([$name, $short_desc, $full_desc, $footer_desc, $id])) {
                $_SESSION["log-mess-s"] = "Запись обновлена";
                echo "<script>location.href = 'https://localhost/cult_conn/admin/new.php';</script>";
            } else {
                echo "<script>alert('Ошибка при обновлении данных новости.');</script>";
            }
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
            $name = $_POST['name'];
            $short_desc = $_POST['short_desc'];
            $full_desc = $_POST['full_desc'];
            $footer_desc = $_POST['footer_desc'];
            $date = date("Y-m-d");
        
            $stmt = $pdo->prepare("INSERT INTO news SET Name = ?, Short_desc = ?, Full_desc = ?, Footer_desc = ?, Date = ?");
            if ($stmt->execute([$name, $short_desc, $full_desc, $footer_desc, $date])) {
                $_SESSION["log-mess-s"] = "Запись сохранена";
                echo "<script>location.href = 'https://localhost/cult_conn/admin/new.php';</script>";
            } else {
                echo "<script>alert('Ошибка при добавлении данных новости.');</script>";
            }
        }
?>
<title>Статья: <?= $new_query_result["Name"] ?></title>
<div class="container mt-5">
        <?php if ($new_query_result): ?>
            <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="form-container">
                    <div class="col-md-8">
                            <div class="mb-3">
                                <label for="id" class="form-label">ID</label>
                                <input type="text" class="form-control" id="id" disabled name="id" value="<?= htmlspecialchars($new_query_result["Id"]) ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Название</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($new_query_result["Name"]) ?>" maxlength="55" required>
                            </div>
                            <div class="mb-3">
                                <label for="short_desc" class="form-label">Краткое описание</label>
                                <textarea class="form-control" id="short_desc" name="short_desc" maxlength="150" required><?= htmlspecialchars($new_query_result["Short_desc"]) ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="full_desc" class="form-label">Полное описание</label>
                                <textarea class="form-control" id="full_desc" name="full_desc" maxlength="320" required><?= htmlspecialchars($new_query_result["Full_desc"]) ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="footer_desc" class="form-label">Подвал (конец) новости</label>
                                <textarea class="form-control" id="footer_desc" name="footer_desc" maxlength="150" required><?= htmlspecialchars($new_query_result["Footer_desc"]) ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Дата</label>
                                <div class="col-lg-3 col-sm-6">
                                    <input id="date" name="date" class="form-control" type="date" disabled required value="<?= htmlspecialchars($new_query_result["Date"]) ?>"/>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" name="update">Сохранить</button>
                            <form method="post">
                                <button class="btn btn-danger" name="delete">Удалить</button>
                            </form>
                        </form>
                    </div>
                </div>
            </div>
        <?php elseif($new_query_result == 0): ?>
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
            <?php endif; ?>
        <?php else: ?>
            <p class="text-muted">Данной статьи не существует :(</p>
        <?php endif; ?>
</div>
<?php else: ?>
        <div class="container mt-5">
                <?php include "./../../error/404.php"; ?> 
        </div>
    <?php
    endif; ?>
<?php include "../../include/footer.php"; ?>