<?php
    include_once("../../Tools/Links.html");
    include_once("../../PHP/DataBase.php");
    include_once("../../PHP/Universal/Universal.php");
    include_once("../../PHP/Product/Product.php");
    include_once("../../PHP/Product/Utilities.php");
    session_start();

    if(!isset($_SESSION['Admin'])){
        header("location: ../../");
    }

    $id = $_GET['Id'];
    $product = get_one_product($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Add_Edit.css">
    <link rel="icon" type="image/x-icon" href="../../Pictures/Main/Logo.png">
    <title>Редактиране</title>
</head>
<body>
    <?php require_once("../Menu.php");?>
    <table class="float-start panel">
        <form action="Process/edit.php" method="post" id="edit" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $_GET['Id']; ?>">
            <tr>
                <td><label for="name">Име:</label></td>
                <td><input type="text" name="name" id="name" autocomplete="off" value="<?php echo $product->get_name();?>" required></td>
            </tr>

            <tr>
                <td><label for="category">Категория:</label></td>
                <td><select name="category" id="category" autocomplete="off">
                    <?php
                        $categories = getAllCategories();
                        foreach ($categories as $category) {
                            ?>
                            <option value="<?php echo $category->get_id();?>" <?php 
                                if($product->get_category() == $category->get_name()){
                                    echo "selected";
                                }
                            ?>><?php echo $category->get_name();?></option>
                            <?php
                        }
                    ?>  
                </select></td>
            </tr>

            <tr>
                <td><label for="price">Цена:</label></td>
                <td><input type="text" name="price" id="price" value="<?php echo $product->get_price();?>" pattern="^[\d]+.[\d]{2}$" autocomplete="off" required></td>
            </tr>

            <tr>
                <td><label for="pieces">Парчета:</label></td>
                <td><input type="number" name="pieces" id="pieces" value="<?php echo $product->get_pieces();?>" autocomplete="off"></td>
            </tr>

            <tr>
                <td><label for="weight">Тежест:</label></td>
                <td><input type="number" name="weight" id="weight" value="<?php echo $product->get_weight();?>" autocomplete="off">
            
                <select name="measurement" id="measurement">
                    <option value="г" <?php 
                        if($product->get_measurement() == "г"){
                            echo "selected";
                        }
                    ?>>г</option>
                    <option value="кг" <?php 
                        if($product->get_measurement() == "кг"){
                            echo "selected";
                        }
                    ?>>кг</option>
                </select></td>
            </tr>

            <tr>
                <td><label for="description">Описание:</label></td>
                <td><textarea name="description" id="description" form="edit" autocomplete="off" cols="30" rows="10"><?php echo $product->get_description();?></textarea></td>
            </tr>

            <tr>
                <td><label for="file">Снимка:</label></td>
                <td><input type="file" id="file" name="file" accept="image/*"></td>
            </tr>

            <tr>
                <td colspan="2"><img id="picture" src="../../Pictures/Products/<?php echo $product->get_picture();?>" alt="picture" width="450px" height="fit-content"></td>
            </tr>

            <tr>
                <td colspan="2" class="text-center"><input class="exit" type="submit" value="Редактиране"></td>
            </tr>
        </form>
    </table>
    <?php
        if(isset($_SESSION['Edit_Success'])){
            echo "<script>window.onload = function(){alert('Успешно редактиране')}</script>";
            unset($_SESSION['Edit_Success']);
        }
    ?>
</body>
<script src="../../JavaScript/AdminPanel/Add_Edit.js"></script>
<script src="../../JavaScript/AdminPanel/Picture.js"></script>
</html>