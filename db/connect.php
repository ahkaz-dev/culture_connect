<?php

date_default_timezone_set('Europe/Moscow');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($GLOBALS['pdo'])) {
    $host = 'localhost';
    $dbname = 'cult_conn';
    $username = 'configurator';
    $password = 'jlJuMXojjOsd_jTX';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $GLOBALS['pdo'] = $pdo;
        // echo "<h6 class=ms-3>Подключено к базе данных ✅</h6>";
    } catch (PDOException $e) {
        // echo "<h6 class=ms-3>Ошибка подключения: " . $e->getMessage() . "</h6>";
        die();
    }
} else {
    $pdo = $GLOBALS['pdo'];
}


