<?php

require_once "../helper/header.php";
require_once "../db/db_connection.php";

$query = 'delete from category where id=?';

$res = $pdo->prepare($query);
$res->execute([$_GET['id']]);

header("location:../category/category.php");