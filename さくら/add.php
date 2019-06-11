<?php

    $user = "root"; $pass = "prai18-SQL"; $price = (int) $_POST['price']; $name = $_POST['name']; $howto = $_POST['howto'];
    try { $dbh = new PDO('mysql:host=localhost;dbname=form1;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO form1 (name, howto, price) VALUES (?, ?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $name, PDO::PARAM_STR);
    $stmt->bindValue(2, $howto, PDO::PARAM_STR);
    $stmt->bindValue(3, $price, PDO::PARAM_INT);
    $stmt->execute();
    $dbh = null;
    echo "データベースへの更新が完了したでござる。";
} catch (Exception $e) {
    echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "
";
    die();
}
?>
