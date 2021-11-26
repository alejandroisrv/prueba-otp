<?php

require 'config.php';

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

try {

    $conn = new PDO($dsn, $username, $password);

} catch (\Exception $e) {
    echo $e->getMessage();
}
