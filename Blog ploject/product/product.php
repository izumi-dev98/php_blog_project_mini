<?php
require_once "../helper/header.php";
require_once "../db/db_connection.php";

$categoryquery = "select id,name from category";

$ress = $pdo->prepare($categoryquery);
$ress->execute();

$categorydata = $ress->fetchAll(PDO::FETCH_ASSOC);
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

    <div class="text-center mt-2">
            <h4>Product Creation Page</h4>
        </div>
        <div class="row mt-3">
            <div class="col text-center mt-3 ">
              <img src="" id="output" height="500px" width="500px">
            </div>

            <div class="col">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="col" style="height:100px">
                    <input type="text" name="productname" class="w-100 h-50 form-control" placeholder="Enter Product name..">
                    <?php

if (isset($_POST['btn'])) {
    $check = $_POST['productname'] == "" ? false : true;
    echo $check ? "" : "Required";
} ?>
                </div>


                <div class="col" style="height:100px">
                <input type="text" name="productprice" class="w-100 h-50 form-control" placeholder="Enter Product price..">
                <?php

if (isset($_POST['btn'])) {
    $check = $_POST['productprice'] == "" ? false : true;
    echo $check ? "" : "Required";
} ?>
                </div>

                <div class="col" style="height:100px">
                    <input type="file" name="image" class="w-100 h-50 form-control" placeholder="Enter Product Images.." onchange="loadFile(event)">
                    <!-- <?php

if (isset($_POST['btn'])) {
    $check = $_POST['image'] == "" ? false : true;
    echo $check ? "" : "Required";
} ?> -->
                </div>

                <div class="col" style="height:100px">
                   <select name="productcategory" id="" class="form-control w-100">

                     <option value="">Choose Category</option>

                   <?php

                    foreach($categorydata as $item){
                        $id = $item['id'];
                        $name = $item['name'];
                        echo "<option value='$id'>$name</option>";
                    }
                               
                   ?>
                      
                   </select>
                </div>

                <div class="col" style="height:100px">
                    <textarea name="productnote" class="form-control w-100" placeholder="Enter Product description.."></textarea>
                    <?php

if (isset($_POST['btn'])) {
    $check = $_POST['productnote'] == "" ? false : true;
    echo $check ? "" : "Required";
} ?>
                </div>

                <div class="col"  style="height:100px">
                    <input type="submit" value="Create Products" class="w-100 h-50 form-control btn btn-success" name="btn">
                </div>
              </form>
            </div>
        </div>
    </div>
</body>

<?php
  if(isset($_POST['btn'])){
    $name =$_POST['productname'];
    $price =$_POST['productprice'];
    // $image =$_FILES['image']['name'];
    $category =$_POST['productcategory'];
    $note =$_POST['productnote'];

    print_r($_FILES);


    if($check){


        $imgname = uniqid(). $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        $target ="../image/" .$imgname;

        move_uploaded_file($tmp,$target);

        $query ="insert into product (name,price,image,note,category_id) values (?,?,?,?,?)";

        $res = $pdo->prepare($query);
        $res->execute([$name,$price,$imgname,$note,$category]);

        header("location:../product/list.php");


    }
  }


?>

<script>
    function loadFile(event){
        let output = document.getElementById("output");

        var reader = new FileReader();

        reader.onload = function(){
            output.src = reader.result
        }

        reader.readAsDataURL(event.target.files[0])
    }
</script>
</html>

