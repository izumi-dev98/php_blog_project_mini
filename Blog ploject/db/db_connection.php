<?php

try {
    $pdo = new PDO("mysql:host=localhost;dbname=project_blog","root","");
    
} catch (PDOException $error) {
    echo"Fail DB Connection";
}

?>