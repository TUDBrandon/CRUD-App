<?php

/**
 * Database Connection
 */

require_once "../config/config.php";

try {
    $connection = new PDO($dsn, $username, $password, $options);
} catch(PDOException $error) {
    echo $error->getMessage();
    die();
}
