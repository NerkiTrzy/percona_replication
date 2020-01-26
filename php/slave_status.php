<?php

try {
    $dbh = new PDO('mysql:host=127.0.0.1;port=8096', 'root', 'root');
    $stmt = $dbh->query('SHOW SLAVE STATUS');
print_r($dbh->errorInfo());
var_dump($stmt);
    var_dump($stmt->fetch());

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
