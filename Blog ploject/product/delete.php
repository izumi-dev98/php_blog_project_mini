<?php

require_once "../helper/header.php";
require_once "../db/db_connection.php";


print_r($_GET);


// $query = "select image from product where id=?";
// $result = $pdo->prepare($query);
// $result->execute([$_GET['id']]);

// $image = $result->fetch(PDO::FETCH_ASSOC);
$imgname = $_GET['oldimg'];


$delete = "delete from product where id=?";
$res = $pdo->prepare($delete);

$res->execute([$_GET["id"]]);

unlink("../image/$imgname");


header("location:../product/list.php");





