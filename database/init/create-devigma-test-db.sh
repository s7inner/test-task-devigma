#!/usr/bin/env bash

# Create devigma_test database for testing environment
mysql --user=root --password="$MYSQL_ROOT_PASSWORD" <<-EOSQL
    CREATE DATABASE IF NOT EXISTS devigma_test;
    GRANT ALL PRIVILEGES ON \`devigma_test\`.* TO '$MYSQL_USER'@'%';
    FLUSH PRIVILEGES;
EOSQL
