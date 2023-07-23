<?php
    require 'funcs.php';

    // Get the POST data
    $unique_num = $_POST['unique_num'];
    $title = $_POST['title'];
    $url = $_POST['url'];
    $comments = $_POST['comments'];

    // Connect to the database
    try {
        $pdo = db_conn();
    } catch (PDOException $e) {
        exit('DB Connection Error:'.$e->getMessage());
    }

    // Prepare the SQL statement to update the record
    $stmt = $pdo->prepare("UPDATE php_kadai02 SET title = :title, url = :url, comments = :comments WHERE unique_num = :unique_num");
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':url', $url, PDO::PARAM_STR);
    $stmt->bindValue(':comments', $comments, PDO::PARAM_STR);
    $stmt->bindValue(':unique_num', $unique_num, PDO::PARAM_INT);
    $status = $stmt->execute();

    // Check the status of the update and redirect accordingly
    if ($status == false) {
        $error = $stmt->errorInfo();
        exit("SQL Error:".$error[2]);
    } else {
        header("Location: select.php");
        exit();
    }
?>
