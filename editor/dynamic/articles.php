<?php include "../../include/header.php"; ?>
<?php include "../../include/message.php"; ?>

<?php 

$Id = (isset($_GET['id'])) ? $_GET['id'] : 0;
$current_u_id = $_SESSION['log-session-data']["Id"];

$query = $pdo->prepare("SELECT articles.*, users.login AS EditorLogin FROM articles JOIN users ON articles.Editor = users.Id WHERE articles.Id=:Id AND articles.Editor =:Editor;");
$query->execute(['Id' => $Id, 'Editor' => $current_u_id]);
$article_query_result = $query->fetch(PDO::FETCH_ASSOC);

?>    
<?php 
if (isset($_SESSION["log-session"]) && isset($_SESSION['log-session-data'])): 
    if ($_SESSION['log-session-data']["Admin"] || $_SESSION['log-session-data']["Editor"]):
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
            $stmt = $pdo->prepare("DELETE FROM articles WHERE Id = :Id");
            $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                $_SESSION["log-mess-warn"] = "Запись удалена";
                echo '<script type="text/javascript">';
                echo 'window.location.href = "http://localhost/cult_conn/editor/article.php";';
                echo '</script>';
            } 
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
            $id = $article_query_result["Id"];
            $name = $_POST['name'];
            $short_desc = $_POST['short_desc'];
            $full_desc = $_POST['full_desc'];
        
            $stmt = $pdo->prepare("UPDATE articles SET Name = ?, Short_desc = ?, Full_desc = ? WHERE articles.Id = ?");
            if ($stmt->execute([$name, $short_desc, $full_desc, $id])) {
                $_SESSION["log-mess-s"] = "Запись обновлена";
                echo "<script>location.href = 'https://localhost/cult_conn/editor/article.php';</script>";
            } else {
                echo "<script>alert('Ошибка при обновлении данных статьи.');</script>";
            }
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
            $name = $_POST['name'];
            $short_desc = $_POST['short_desc'];
            $full_desc = $_POST['full_desc'];
            $date = date("Y-m-d");
            $editor = $_SESSION['log-session-data']['Id'];
        
            $stmt = $pdo->prepare("INSERT INTO articles SET Name = ?, Short_desc = ?, Full_desc = ?, Date = ?, Editor = ?");
            if ($stmt->execute([$name, $short_desc, $full_desc, $date, $editor])) {
                $_SESSION["log-mess-s"] = "Запись сохранена";
                echo "<script>location.href = 'https://localhost/cult_conn/editor/article.php';</script>";
            } else {
                echo "<script>alert('Ошибка при добавлении данных статьи.');</script>";
            }
        }
?>
<div class="container mt-5">
        <?php if ($article_query_result): ?>
            <title>Статья: <?= $article_query_result["Name"] ?></title>
            <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="form-container">
                    <div class="col-md-8">
                            <div class="mb-3">
                                <label for="id" class="form-label">ID</label>
                                <input type="text" class="form-control" id="id" disabled name="id" value="<?= htmlspecialchars($article_query_result["Id"]) ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Название</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($article_query_result["Name"]) ?>" maxlength="55" required>
                            </div>
                            <div class="mb-3">
                                <label for="short_desc" class="form-label">Краткое описание</label>
                                <textarea class="form-control" id="short_desc" name="short_desc" maxlength="150" required><?= htmlspecialchars($article_query_result["Short_desc"]) ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="full_desc" class="form-label">Полное описание</label>
                                <textarea class="form-control" id="full_desc" name="full_desc" maxlength="320" required><?= htmlspecialchars($article_query_result["Full_desc"]) ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Дата</label>
                                <div class="col-lg-3 col-sm-6">
                                    <input id="date" name="date" class="form-control" type="date" disabled required value="<?= htmlspecialchars($article_query_result["Date"]) ?>"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="editor" class="form-label">Автор статьи</label>
                                <input type=text class="form-control" id="editor" disabled name="editor" maxlength="55" required value=<?= htmlspecialchars($article_query_result["EditorLogin"]) ?>>
                            </div>
                            <button type="submit" class="btn btn-primary" name="update">Сохранить</button>
                            <form method="post">
                                <button class="btn btn-danger" name="delete">Удалить</button>
                            </form>
                        </form>
                    </div>
                </div>
            </div>
        <?php elseif($article_query_result == 0): ?>
            <title>Создать новую статью</title>
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
                                <label for="date" class="form-label">Дата</label>
                                <div class="col-lg-3 col-sm-6">
                                    <input id="date" class="form-control" type="date" disabled required format="yyyy-mm-dd" value="<?= date("Y-m-d") ?>"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="editor" class="form-label">Автор статьи</label>
                                <input type=text class="form-control" id="editor" disabled name="editor" maxlength="55" required value=<?= $_SESSION['log-session-data']['Login'] ?>>
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