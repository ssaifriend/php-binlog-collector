docker run -p 3306:3306  --name db-master -e MYSQL_ROOT_PASSWORD=1234 -v /Users/kobi/workspace/php-binlog-collector/demo/Resources/mariadb/my.master.cnf:/etc/mysql/my.cnf -v /Users/kobi/workspace/php-binlog-collector/demo/Resources/mariadb/:/temp -d mariadb:10.0.27
docker run -p 3307:3306 --name db-slave --link db-master:master -e MYSQL_ROOT_PASSWORD=1234 -v /Users/kobi/workspace/php-binlog-collector/demo//Resources/mariadb/my.slave.cnf:/etc/mysql/my.cnf -v /Users/kobi/workspace/php-binlog-collector/demo/Resources/mariadb/:/temp -d mariadb:10.0.27
docker run -p 3308:3306  --name db-slave-slave --link db-slave:slave -e MYSQL_ROOT_PASSWORD=1234 -v /Users/kobi/workspace/php-binlog-collector/demo//Resources/mariadb/my.slave-slave.cnf:/etc/mysql/my.cnf -v /Users/kobi/workspace/php-binlog-collector/demo/Resources/mariadb/:/temp -d mariadb:10.0.27
