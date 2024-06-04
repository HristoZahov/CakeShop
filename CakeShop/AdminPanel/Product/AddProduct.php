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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Add_Edit.css">
    <link rel="icon" type="image/x-icon" href="../../Pictures/Main/Logo.png">
    <title>Добавяне</title>
</head>
<body>
    <?php require_once("../Menu.php");?>
    <table class="float-start panel">
        <form action="Process/add.php" method="post" id="add" enctype="multipart/form-data">
            <tr>
                <td><label for="name">Име:</label></td>
                <td><input type="text" name="name" id="name" autocomplete="off" required></td>
            </tr>

            <tr>
                <td><label for="category">Категория:</label></td>
                <td><select name="category" id="category" autocomplete="off">
                    <?php
                        $categories = getAllCategories();
                        foreach ($categories as $category) {
                            ?>
                            <option value="<?php echo $category->get_id();?>"><?php echo $category->get_name();?></option>
                            <?php
                        }
                    ?>  
                </select></td>
            </tr>

            <tr>
                <td><label for="price">Цена:</label></td>
                <td><input type="text" name="price" id="price" pattern="^[\d]+.[\d]{2}$" autocomplete="off" required></td>
            </tr>

            <tr>
                <td><label for="pieces">Парчета:</label></td>
                <td><input type="number" name="pieces" id="pieces" autocomplete="off"></td>
            </tr>

            <tr>
                <td><label for="weight">Тежест:</label></td>
                <td><input type="number" name="weight" id="weight" autocomplete="off">
            
                <select name="measurement" id="measurement">
                    <option value="г">г</option>
                    <option value="кг">кг</option>
                </select></td>
            </tr>

            <tr>
                <td><label for="description">Описание:</label></td>
                <td><textarea name="description" id="description" form="add" autocomplete="off" cols="30" rows="10"></textarea></td>
            </tr>

            <tr>
                <td><label for="file">Снимка:</label></td>
                <td><input type="file" id="file" name="file" accept="image/*" required></td>
            </tr>

            <tr>
                <td colspan="2"><img id="picture" src="" alt="picture" width="450px" height="fit-content" style="display:none;" required></td>
            </tr>

            <tr>
                <td colspan="2" class="text-center"><input class="exit" type="submit" value="Добавяне"></td>
            </tr>
        </form>
    </table>
    <?php
        if(isset($_SESSION['Add_Success'])){
            echo "<script>window.onload = function(){alert('Успешно добавяне')}</script>";
            unset($_SESSION['Add_Success']);
        }
    ?>
</body>
<script src="../../JavaScript/AdminPanel/Add_Edit.js"></script>
<script src="../../JavaScript/AdminPanel/Picture.js"></script>
</html>