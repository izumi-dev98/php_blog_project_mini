<?php
require_once "../helper/header.php";
require_once "../db/db_connection.php";




$categoryquery = "select * from category";

$ress = $pdo->prepare($categoryquery);
$ress->execute();

$categorydata = $ress->fetchAll(PDO::FETCH_ASSOC);



$categoryquerys = "select * from product where id=?";

$resss = $pdo->prepare($categoryquerys);
$resss->execute([$_GET['id']]);

$categorydatas = $resss->fetch(PDO::FETCH_ASSOC);



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
            <h4>Product Change Page</h4>
        </div>

        <div class="row mt-3">
        <div class="col text-center mt-3">
              <img src="../image/<?php echo $categorydatas['image']?>" id="output" height="500px" width="500px">
            </div>

            <div class="col">
                <form action="" method="post" enctype="multipart/form-data">
                <div class="col" style="height:100px">
                    <input type="text" name="productname" class="w-100 h-50 form-control" placeholder="Enter Product name.." value="<?php echo $_POST['productname']?? $categorydatas['name']?>">
                    <?php

if (isset($_POST['btn'])) {
    $check = $_POST['productname'] == "" ? false : true;
    echo $check ? "" : "Required";
} ?>
                </div>
                <div class="col" style="height:100px">
                <input type="text" name="productprice" class="w-100 h-50 form-control" placeholder="Enter Product price.." value="<?php echo $_POST['productprice']?? $categorydatas['price']?>">
                <?php

if (isset($_POST['btn'])) {
    $check = $_POST['productprice'] == "" ? false : true;
    echo $check ? "" : "Required";
} ?>
                </div>
                <div class="col" style="height:100px">
                    <input type="file" name="image" class="w-100 h-50 form-control" placeholder="Enter Product Images.." onchange="loadFile(event)" >
                


                </div>
                <div class="col" style="height:100px">
                    <textarea name="productnote" class="form-control w-100" placeholder="Enter Product description.." value=""><?php echo $_POST['productnote']?? $categorydatas['note']?></textarea>
                    <?php

if (isset($_POST['btn'])) {
    $check = $_POST['productnote'] == "" ? false : true;
    echo $check ? "" : "Required";
} ?>
                </div>

                <div class="col" style="height:100px">
                   <select name="productcategory" id="" class="form-control w-100">

                    

                   <?php

                    foreach($categorydata as $item){
                        $id = $item['id'];
                        $name = $item['name'];
                       
                        echo "<option value='".$id."'".($id == $categorydatas['category_id'] ? "selected": "")."> $name </option>";
                    }
                               
                   ?>
                      
                   </select>
                </div>

                <div class="col"  style="height:100px">
                    <input type="submit" value="Create Products" class="w-100 h-50 form-control btn btn-success" name="btn">
                </div>

                
             

                
               
                </form>
            </div>
        </div>
    </div>

    <?php
  if(isset($_POST['btn'])){
    $name =$_POST['productname'];
    $price =$_POST['productprice'];
    // $image =$_FILES['image']['name'];
    $category =$_POST['productcategory'];
    $note =$_POST['productnote'];

    print_r($_FILES);


    if($check){


        if($_FILES['image']['name'] != ""){

            $oldimg = $categorydatas['image'];
            unlink("../image/$oldimg");
             $imgname = uniqid(). $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        $target ="../image/" .$imgname;

        move_uploaded_file($tmp,$target);


        $update = 'update product set name=?,price=?,image=?,note=?,category_id=? where id=?';

        $up = $pdo->prepare($update);
        $up->execute([$name,$price,$imgname,$note,$category,$_GET['id']]);

        } else{
            $update = 'update product set name=?,price=?,note=?,category_id=? where id=?';

            $up = $pdo->prepare($update);
            $up->execute([$name,$price,$note,$category,$_GET['id']]);
        }

        

        header("location:../product/list.php");


    }
  }


?>
</body>
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
