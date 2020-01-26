# percona_replication

Project to test database replication problems.


## Ustawienia master
* Nadanie uprawnień slavowi, gdzie ``10.5.0.3`` to ip slava
```sql
GRANT REPLICATION SLAVE ON *.*  TO 'root'@'10.5.0.3'
 IDENTIFIED BY 'root';
```
## Ustawienia slave
* przypisanie mastera
```sql
 CHANGE MASTER TO
                MASTER_HOST='10.5.0.2',
                MASTER_USER='root',
                MASTER_PASSWORD='root',
                MASTER_LOG_FILE='master-bin.000001',
                MASTER_LOG_POS=0;
```
* kontrolowanie replikacji
````sql
start slave;
stop slave;
reset slave;
SHOW SLAVE STATUS;

````

## Przeglądanie bin-loga
````sql
 mysqlbinlog --base64-output=decode-rows -vv master-bin.000016 
````