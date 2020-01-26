<?php

$args = getopt('t:p:');
$howManyTimes = (int)$args['t'];
$withPk = (bool)($args['p'] ?? false);
try {
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=test;port=8095', 'ist', 'ist');
    $tableName = $withPk ? 'new_table_pk' : 'new_table';

    for($i = 1; $i <= $howManyTimes; $i++) {
        $dbh->query('insert into '.$tableName.' (category_root, category_main)  values(\'CROPP\', \'MAN\');');
    }
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
