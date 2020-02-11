<?php

try {
    $dbh = new PDO('mysql:host=db-slave;port=3306', 'root', 'root');

    $stmt = $dbh->query('SHOW SLAVE STATUS');
    $result = $stmt->fetch();
    header('Content-Type: application/json');

    echo json_encode($result);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
