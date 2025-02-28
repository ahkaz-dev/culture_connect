<?php include "../../include/header.php"; ?>
<?php include "../../include/message.php"; ?>

<?php 

$Id = (isset($_GET['id'])) ? $_GET['id'] : 0;
$query = $pdo->prepare("SELECT * FROM museums WHERE Id=:Id");
$query->execute(['Id' => $Id]);
$museum_query_result = $query->fetch(PDO::FETCH_ASSOC);


?>    
<?php 
if (isset($_SESSION["log-session"]) && isset($_SESSION['log-session-data'])): 
    if ($_SESSION['log-session-data']["Admin"]):
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
            $stmt = $pdo->prepare("DELETE FROM museums WHERE Id = :Id");
            $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                $_SESSION["log-mess-warn"] = "Запись удалена";
                echo '<script type="text/javascript">';
                echo 'window.location.href = "http://localhost/cult_conn/admin/museum.php";';
                echo '</script>';
            } 
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $short_desc = $_POST['short_desc'];
            $full_desc = $_POST['full_desc'];
        
            if (isset($_FILES['image'])) {
            $image_path = '../../uploads/' . basename($_FILES['image']['name']);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                    $stmt = $pdo->prepare("UPDATE Museums SET Image_path = ? WHERE Id = ?");
                    if ($stmt->execute([$image_path, $id])) {
                        echo "<script>alert('Изображение успешно сохранено!');</script>";
                    } else {
                        echo "<script>alert('Ошибка при сохранении изображения в базе данных.');</script>";
                    }
                }
            } else {
                echo "<script>alert('Ошибка.');</script>";
            } 
        
            $stmt = $pdo->prepare("UPDATE Museums SET Name = ?, Short_desc = ?, Full_desc = ? WHERE Id = ?");
            if ($stmt->execute([$name, $short_desc, $full_desc, $id])) {
                $_SESSION["log-mess-s"] = "Запись обновлена";
                $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                echo "<script>location.href = 'https://localhost/cult_conn/admin/dynamic/museums.php?id=$id';</script>";
            } else {
                echo "<script>alert('Ошибка при обновлении данных музея.');</script>";
            }
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
            $name = $_POST['name'];
            $short_desc = $_POST['short_desc'];
            $full_desc = $_POST['full_desc'];
        
            if (isset($_FILES['image'])) {
            $image_path = '../../uploads/' . basename($_FILES['image']['name']);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                    $stmt = $pdo->prepare("INSERT INTO Museums SET Name = ?, Short_desc = ?, Full_desc = ?, Image_path = ?");
                    if ($stmt->execute([$name, $short_desc, $full_desc, $image_path])) {
                        $_SESSION["log-mess-s"] = "Запись сохранена";
                        $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        echo "<script>location.href = 'https://localhost/cult_conn/admin/museum.php';</script>";
                    } else {
                        echo "<script>alert('Ошибка при добавлении данных музея.');</script>";
                    }
                }
            } else {
                echo "<script>alert('Ошибка.');</script>";
            } 
        }
?>
<style>
    .image-preview {
        max-width: 100%;
        height: auto;
        margin-bottom: 1rem;
    }
    .form-container {
        display: flex;
        align-items: flex-start;
    }
    .form-container .image-column {
        margin-right: 20px;
    }
</style>
<title>Музей: <?= $museum_query_result["Name"] ?></title>
<div class="container mt-5">
        <?php if ($museum_query_result): ?>
            <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="form-container">
                    <div class="col-md-4 image-column">
                        <img src="/cult_conn/uploads/<?= htmlspecialchars(basename($museum_query_result['Image_path'])) ?>" class="image-preview img-fluid" alt="Музей">
                        <div class="mb-3">
                            <label for="image" class="form-label">Изображение</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="validateImageSize(this)">
                        </div>
                    </div>
                    <div class="col-md-8">
                            <div class="mb-3">
                                <label for="id" class="form-label">ID</label>
                                <input type="text" class="form-control" id="id" name="id" value="<?= htmlspecialchars($museum_query_result["Id"]) ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Название</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($museum_query_result["Name"]) ?>" maxlength="55" required>
                            </div>
                            <div class="mb-3">
                                <label for="short_desc" class="form-label">Краткое описание</label>
                                <textarea class="form-control" id="short_desc" name="short_desc" maxlength="150" required><?= htmlspecialchars($museum_query_result["Short_desc"]) ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="full_desc" class="form-label">Полное описание</label>
                                <textarea class="form-control" id="full_desc" name="full_desc" maxlength="320" required><?= htmlspecialchars($museum_query_result["Full_desc"]) ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="update">Сохранить</button>
                            <form method="post">
                                <button class="btn btn-danger" name="delete">Удалить</button>
                            </form>
                        </form>
                    </div>
                </div>
            </div>
        <?php elseif($museum_query_result == 0): ?>
            <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="form-container">
                    <div class="col-md-4 image-column">
                        <img class="image-preview img-fluid" alt="Музей">
                        <div class="mb-3">
                            <label for="image" class="form-label">Изображение</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="validateImageSize(this)">
                        </div>
                    </div>
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
                            <button type="submit" class="btn btn-primary" name="save">Сохранить</button>
                            <button class="btn btn-second" type="reset">Очистить</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        <?php else: ?>
            <p class="text-muted">Данного музея не существует :(</p>
        <?php endif; ?>
</div>
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
<?php else: ?>
        <div class="container mt-5">
                <?php include "./../../error/404.php"; ?> 
        </div>
    <?php
    endif; ?>
<?php include "../../include/footer.php"; ?>