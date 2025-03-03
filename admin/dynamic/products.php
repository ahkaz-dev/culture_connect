<?php include "../../include/header.php"; ?>
<?php include "../../include/message.php"; ?>

<?php 

$Id = (isset($_GET['id'])) ? $_GET['id'] : 0;
$query = $pdo->prepare("SELECT * FROM product WHERE Id=:Id");
$query->execute(['Id' => $Id]);
$product_query_result = $query->fetch(PDO::FETCH_ASSOC);

?>    
<?php 
if (isset($_SESSION["log-session"]) && isset($_SESSION['log-session-data'])): 
    if ($_SESSION['log-session-data']["Admin"]):
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
            $stmt = $pdo->prepare("DELETE FROM product WHERE Id = :Id");
            $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                $_SESSION["log-mess-warn"] = "Запись удалена";
                echo '<script type="text/javascript">';
                echo 'window.location.href = "http://localhost/cult_conn/admin/product.php";';
                echo '</script>';
            } 
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
            $id = $product_query_result["Id"];
            $name = $_POST['name'];
            $short_desc = $_POST['short_desc'];
            $full_desc = $_POST['full_desc'];
            $price = $_POST['price'];
            $available = $_POST['available'] == 1 ? 'Yes' : 'No';

            if (isset($_FILES['image'])) {
            $image_path = '../../uploads/products/' . basename($_FILES['image']['name']);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                    $stmt = $pdo->prepare("UPDATE product SET Image_path = ? WHERE Id = ?");
                    if ($stmt->execute([$image_path, $id])) {
                        echo "<script>alert('Изображение успешно сохранено!');</script>";
                    } else {
                        echo "<script>alert('Ошибка при сохранении изображения в базе данных.');</script>";
                    }
                }
            } else {
                echo "<script>alert('Ошибка.');</script>";
            } 
        
            $stmt = $pdo->prepare("UPDATE product SET Name = ?, Short_desc = ?, Full_desc = ?, Price = ?, Available = ? WHERE Id = ?");
            if ($stmt->execute([$name, $short_desc, $full_desc, $price, $available, $id])) {
                $_SESSION["log-mess-s"] = "Запись обновлена";
                echo "<script>location.href = 'https://localhost/cult_conn/admin/product.php';</script>";
            } else {
                echo "<script>alert('Ошибка при обновлении данных товара.');</script>";
            }
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
            $name = $_POST['name'];
            $short_desc = $_POST['short_desc'];
            $full_desc = $_POST['full_desc'];
            $price = $_POST['price'];
            $available = $_POST['available'] == 1 ? 'Yes' : 'No';

            if (isset($_FILES['image'])) {
            $image_path = '../../uploads/products/' . basename($_FILES['image']['name']);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                    $stmt = $pdo->prepare("INSERT INTO product SET Name = ?, Short_desc = ?, Full_desc = ?, Price = ?, Available = ?, Image_path = ?");
                    if ($stmt->execute([$name, $short_desc, $full_desc, $price, $available, $image_path])) {
                        $_SESSION["log-mess-s"] = "Запись сохранена";
                        echo "<script>location.href = 'https://localhost/cult_conn/admin/product.php';</script>";
                    } else {
                        echo "<script>alert('Ошибка при добавлении данных товара.');</script>";
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
<title>Товар: <?= $product_query_result["Name"] ?></title>
<div class="container mt-5">
        <?php if ($product_query_result): ?>
            <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="form-container">
                    <div class="col-md-4 image-column">
                        <img loading="lazy" src="/cult_conn/uploads/products/<?= htmlspecialchars(basename($product_query_result['Image_path'])) ?>" class="image-preview img-fluid" alt="Музей">
                        <div class="mb-3">
                            <label for="image" class="form-label">Изображение</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="validateImageSize(this)">
                        </div>
                    </div>
                    <div class="col-md-8">
                            <div class="mb-3">
                                <label for="id" class="form-label">ID</label>
                                <input type="text" class="form-control" id="id" disabled name="id" value="<?= htmlspecialchars($product_query_result["Id"]) ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Название</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($product_query_result["Name"]) ?>" maxlength="55" required>
                            </div>
                            <div class="mb-3">
                                <label for="short_desc" class="form-label">Краткое описание</label>
                                <textarea class="form-control" id="short_desc" name="short_desc" maxlength="150" required><?= htmlspecialchars($product_query_result["Short_desc"]) ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="full_desc" class="form-label">Полное описание</label>
                                <textarea class="form-control" id="full_desc" name="full_desc" maxlength="320" required><?= htmlspecialchars($product_query_result["Full_desc"]) ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Цена</label>
                                <input type="number" min="500" step="any" class="form-control" id="price" name="price" value="<?= htmlspecialchars($product_query_result["Price"]) ?>" maxlength="55" required />
                            </div>
                            <div class="mb-3">
                                <label for="id" class="form-label">Наличие</label>
                                <select class="form-select form-select-sm mb-3" name="available">
                                    <option >Выберите статус в меню</option>
                                    <option value="1" <?php echo ($product_query_result["Available"]) == 'Yes' ? 'selected': ''; ?>>Присутствует</option>
                                    <option value="2" <?php echo ($product_query_result["Available"]) == 'No' ? 'selected':''; ?>>Отсутсвует</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" name="update">Сохранить</button>
                            <form method="post">
                                <button class="btn btn-danger" name="delete">Удалить</button>
                            </form>
                        </form>
                    </div>
                </div>
            </div>
        <?php elseif($product_query_result == 0): ?>
            <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="form-container">
                    <div class="col-md-4 image-column">
                        <img class="image-preview img-fluid" alt="Музей">
                        <div class="mb-3">
                            <label for="image" class="form-label">Изображение</label>
                            <input type="file" required class="form-control" id="image" name="image" accept="image/*" onchange="validateImageSize(this)">
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
                            <div class="mb-3">
                                <label for="name" class="form-label">Цена</label>
                                <input type="number" min="500" step="any" class="form-control" id="price" name="price"  maxlength="55" required />
                            </div>
                            <div class="mb-3">
                            <div class="mb-3">
                                <label for="id" class="form-label">Наличие</label>
                                <select class="form-select form-select-sm mb-3" name="available">
                                    <option selected disabled>Выберите статус в меню</option>
                                    <option value="1">Присутствует</option>
                                    <option value="2">Отсутсвует</option>
                                </select>
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