<?php 
define('HOST', '192.168.0.35');
define('USER', 'postgres');
define('PASS', 'contabil');
define('DBNAME', 'log_kanban');

//$conn = mysqli_connect(HOST, USER, PASS, DBNAME);

//$conn = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';', USER, PASS);

$conn = new PDO('pgsql:host=192.168.0.35; port=5432;dbname=log_kanban;user=postgres;password=contabil;');
?>