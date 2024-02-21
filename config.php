<?php session_start();

//$pdo = new PDO('mysql:host=108.179.252.175;dbname=aliend68_cliente', 'aliend68_admin', 'Aliendev@pssd4');

$pdo = new PDO('mysql:host=108.179.252.175;dbname=aliend68_imobdev', 'aliend68_admin', 'Aliendev@pssd4');

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);