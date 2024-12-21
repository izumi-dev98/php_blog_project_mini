<?php

require_once "../helper/header.php";
require_once "../db/db_connection.php";

$query =" select product.id,product.name as product_name,price,image,note,category.name as categoty_name from product left join category
on product.category_id = category.id";

$res = $pdo->prepare($query);
$res->execute();

$data = $res->fetchAll(PDO::FETCH_ASSOC);


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
        <div class="text-center">
            <h3>Products LISTS</h3>
        </div>

        <div class="">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">Product Name</th>
      <th scope="col">Category Name</th>
      <th scope="col">Prices</th>
      <th scope="col">Images</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
      <th scope="col">Action</th>

      

    </tr>
  </thead>
      <?php

    foreach($data as $item){
        $productName = $item['product_name'];
        $categoryNam = $item['categoty_name'];
        $price = $item['price'];
        $img = $item['image'];
        $note = $item['note'];
        $id = $item['id'];

        echo "<tbody>
    <tr>
      
      <td>$productName</td>
      <td>$categoryNam</td>
      <td>$price</td>
      <td><img src='../image/$img' height='100px' width='100px'></td>
      <td>$note</td>
      <td> <a href='./update.php?id=$id'><i class='fa-solid fa-pen-to-square'></i></a></td>
      <td><a href='./delete.php?id=$id&oldimg=$img'><i class='fa-solid fa-trash'></i></a></td>
    </tr>
   
  </tbody>";
    }

?>
</table>
        </div>
    </div>
</body>
</html>


