<?php

require_once "../helper/header.php";
require_once "../db/db_connection.php";



$query = "select name from category where id=?";
$res = $pdo->prepare($query);
$res->execute([$_GET['id']]);

$data = $res->fetch(PDO::FETCH_ASSOC);

print_r($data);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div class="container">

    <div class="text-center">
        <h3>Change Category Name</h3>
    </div>
        <div class="row mt-5">
            <form action="" method="post">
                <div class="col-4 offset-4">
                    <input type="text" name="categoryname" class="form-control" value="<?php echo $_POST['categoryname'] ?? $data['name']?>">
                    <?php

if (isset($_POST['btn'])) {
    $checkName = $_POST['categoryname'] == '' ? false : true;
    echo $checkName ? " " : "  <small class='text-danger'>Required name!</small>";
}
?>
                </div>

                <div class="col-4 offset-4">
                    <input type="submit" value="Change Category Name" class="form-control btn btn-success mt-3" name="btn">
                </div>
            </form>
        </div>
    </div>

    <?php
        
        if(isset($_POST['btn'])){
            $name = $_POST['categoryname'];

          if($checkName){

            $update = "update category set name=? where id=?";
            $res = $pdo->prepare($update);
            $res->execute([$name,$_GET['id']]);

            header("location:../category/category.php");
          }
        }

?>
</body>
</html>