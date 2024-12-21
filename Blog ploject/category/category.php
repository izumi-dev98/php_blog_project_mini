<?php
require_once "../helper/header.php";
require_once "../db/db_connection.php";

$readquery = "select id,name from category";

$read = $pdo->prepare($readquery);
$read->execute();

$namecategory = $read->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="text-center mt-5">
            <h1>Category Page</h1>
        </div>


        <div class="row mt-5">
            <div class="col-6">
                <form action="" method="post">
               <div class="col" style="height : 100px">
                <input type="text" name="categoryname" placeholder="Enter Category Name" class="h-50 w-50" ><br>
                <?php

if (isset($_POST['btn'])) {
    $check = $_POST['categoryname'] == "" ? false : true;
    echo $check ? "" : "Required";
}

?>
               </div>
               <div class="col">
                <input type="submit" value="Create Category" name="btn" class="mt-1 btn btn-success">
               </div>
            </form>
        </div>
            <div class="col-6 text-center">


            <div>
            <table class="table">
  <thead>
    <tr>

      <th scope="col">category name</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>

  <?php

if (isset($_POST['btn'])) {
    $catagoryname = $_POST["categoryname"];

    if ($check) {
        $query = "insert into category (name) values (?)";
        $res = $pdo->prepare($query);
        $res->execute([$catagoryname]);

        header("location:../category/category.php");

    }
}

foreach ($namecategory as $item) {
    $name = $item['name'];
    $id = $item['id'];

    echo "
     <tbody>
    <tr>

      <td>$name</td>
      <td> <a href='./update.php?id=$id'><i class='fa-solid fa-pen-to-square'></i></a></td>
      <td><a href='./delete.php?id=$id'><i class='fa-solid fa-trash'></i></a></td>
    </tr>

  </tbody>
    ";
}
;

?>

</table>
            </div>


            </div>;


    <!-- <?php
//   if(isset($_POST['btn'])){
//     $catagoryname = $_POST["categoryname"];

//     if($check){
//         $query = "insert into category (name) values (?)";
//         $res = $pdo->prepare($query);
//         $res->execute([$catagoryname]);

// header("location:../category/category.php");

//     }
//   }
?> -->
</body>
</html>