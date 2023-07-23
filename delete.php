<?php
    require './db_connect.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // $dsn = 'mysql:dbname=b18c96r_gs_db;host=mysql57.b18c96r.sakura.ne.jp';
    // $user = 'b18c96r';
    // $password = 'db_sxe10';

    try {
        $pdo = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        exit();
    }

    $unique = $_GET['unique_num'];
    // var_dump($_GET['unique_num']);

    $sql = "DELETE FROM php_kadai02 WHERE unique_num = :unique_num";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':unique_num', $unique, PDO::PARAM_INT);
    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $stmt->errorInfo();
    }

    $sql = "SET @num := 0";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $sql = "UPDATE php_kadai02 SET unique_num = @num := (@num + 1)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    header("Location: select.php");
?>
