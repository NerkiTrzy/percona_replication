<?php

$args = getopt('c:t:');
$count = (int)$args['c'];
$tableName = (string)($args['t'] ?? 'mapping_with_index');
try {
    $dbh = new PDO('mysql:host=db-master;dbname=db_replication;port=3306', 'ist', 'ist');
    for($i = 1; $i <= $count; $i++) {
        $result = $dbh->query("insert into $tableName (brand, department, category, special_category)  values('CROPP', 'MAN', 'CLOTHES', 'JEANS');");
        if (!$result) {
            var_dump( $dbh->errorInfo());
            break;
        }
        echo "INSERTED". PHP_EOL;
    }

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
