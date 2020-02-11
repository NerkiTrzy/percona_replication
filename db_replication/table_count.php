<?php

$queries = [
    'mapping_with_index_' => 'SELECT COUNT(*) from mapping_with_index;',
    'mapping_with_index_uniq_data_' => 'SELECT COUNT(*) from mapping_with_index_uniq_data;',
    'mapping_without_pk_' => 'SELECT COUNT(*) from mapping_without_pk;',
    'mapping_with_pk_' => 'SELECT COUNT(*) from mapping_with_pk;',
];
$result = [];

try {

    $connections = [
        'slave' => new PDO('mysql:host=db-slave;dbname=db_replication;port=3306', 'root', 'root'),
        'master' => new PDO('mysql:host=db-master;dbname=db_replication;port=3306', 'root', 'root')
    ];

    foreach ($connections as $connectionName => $connection) {
        foreach ($queries as $key => $query) {
            $stmt = $connection->query($query);
            if (!$stmt) {
                var_dump( $connection->errorInfo());
                break;
            }
            $result[] = [
                'key' => $key . $connectionName,
                'value' => $stmt->fetchColumn()
            ];
        }
    }


    header('Content-Type: application/json');

    echo json_encode($result);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
