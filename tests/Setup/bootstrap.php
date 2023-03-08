<?php

/*
 * In the php docker compose image we need the following env:
 * - the database host to "mysql"
 * - the database port to 3306
 */

$config = [
    'DB_HOST' => 'mysql',
    'DB_PORT' => '3306',
];

foreach ($config as $name => $value) {
    putenv("$name=$value");
    $_ENV[$name] = $value;
}

echo "Overriding config in bootstrap.php to: \n";
print_r($config);
