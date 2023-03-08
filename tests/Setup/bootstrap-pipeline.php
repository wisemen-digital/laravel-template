<?php

/*
 * In the bitbucket pipeline we need to set:
 * - the database host to 127.0.0.1
 * - the database port to 3306
 */

$config = [
    'DB_HOST' => '127.0.0.1',
    'DB_PORT' => '3306',
];

foreach ($config as $name => $value) {
    putenv("$name=$value");
    $_ENV[$name] = $value;
}

echo "Overriding config in bootstrap-pipeline.php to: \n";
print_r($config);
