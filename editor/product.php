<?php include "../include/header.php"; ?>
<?php include "../include/message.php"; ?>

<title>Админ-панель | Товары</title>
<?php 
if (isset($_SESSION["log-session"]) && isset($_SESSION['log-session-data'])): 
    if ($_SESSION['log-session-data']["Admin"] || $_SESSION['log-session-data']["Editor"]):
        $current_u_id = $_SESSION['log-session-data']["Id"];
        
        $query = $pdo->prepare("SELECT product.*, users.login as EditorLogin FROM product JOIN users ON product.editor = users.id  WHERE product.editor = ? ORDER BY product.id;");
        $query->execute([$current_u_id]);

        $products_query_result = $query->fetchAll(PDO::FETCH_ASSOC);
?>
    <div class="container mt-5">
        <h2 class="mb-4">Информация о моих товарах</h2>
        <div class="mb-3">
            <form method="post">
                <a class="btn btn-primary" href="/cult_conn/editor/dynamic/products.php">Добавить запись</a>
            </form>
        </div>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Краткое описание</th>
                    <th>Полное описание</th>
                    <th>Цена</th>
                    <th>В наличии</th>
                    <th>Кто добавил товар</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products_query_result)): ?>
                    <!-- echo "<tr>"; -->
                <?php else: ?>
                    <?php foreach ($products_query_result as $product) { ?>
                        <tr>
                            <th scope="row"><?= htmlspecialchars($product["Id"]) ?></th>
                            <td><?= htmlspecialchars($product["Name"]) ?></td>
                            <td><?= htmlspecialchars($product["Short_desc"]) ?></td>
                            <td><?= htmlspecialchars($product["Full_desc"]) ?></td>
                            <td><?= htmlspecialchars($product["Price"]) ?></td>

                            <td><?php echo htmlspecialchars($product["Available"]) == 'Yes' ? 'В наличии' : 'Отсутствует'; ?></td>

                            <td><?= htmlspecialchars($product["EditorLogin"]) ?></td>

                            <td><a href="/cult_conn/editor/dynamic/products.php?id=<?= htmlspecialchars($product["Id"])?>">Редактировать</a></td>
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