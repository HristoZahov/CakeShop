<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <?php
        session_start();
        include "../../PHPUtilities/Type.php";

        if(isset($_SESSION['add_error'])){
            $error = $_SESSION['add_error'];
            foreach ($error as $key => $value) {
                ?>
                <p><?php echo $value; ?></p>
                <?php
            }
            unset($_SESSION['add_error']);
        }
        $types = getAllTypes();
    ?>
    <a href="ShowProducts.php">Назад</a>
    <form id="form" action="Procces/add.php" method="post" enctype="multipart/form-data">
        <label for="name">Име</label><br>
        <input type="text" name="name" id="name" value="<?php if(isset($_SESSION['add_data'])){echo $_SESSION['add_data'][0];} ?>" autocomplete="off"><br>
        
        <label for="price">Цена</label><br>
        <input type="text" name="price" id="price" value="<?php if(isset($_SESSION['add_data'])){echo $_SESSION['add_data'][1];} ?>" autocomplete="off"><br>

        <label for="type">Тип</label><br>
        <select id="type" name="type">
            <option value="">Изберете</option>
            <?php
            foreach ($types as $key => $value) {
            ?>
            <option <?php if(isset($_SESSION['add_data']) && $_SESSION['add_data'][2] == $value['Type']){echo "selected";} ?> value="<?php echo $value['Type']; ?>"><?php echo $value['Type']; ?></option>
            <?php
            }
            ?>
        </select><br>

        <label for="pieces">Парчета</label><br>
        <input type="number" name="pieces" id="pieces" value="<?php if(isset($_SESSION['add_data'])){echo $_SESSION['add_data'][3];} ?>"><br>

        <label for="weight">Тегло</label><br>
        <input type="number" name="weight" id="weight" value="<?php if(isset($_SESSION['add_data'])){echo $_SESSION['add_data'][4];} ?>">
        <select id="measurement" name="measurement">
            <option <?php if(isset($_SESSION['add_data']) && $_SESSION['add_data'][5] == "kg"){echo "selected";} ?> value="kg">кг</option>
            <option <?php if(isset($_SESSION['add_data']) && $_SESSION['add_data'][5] == "g"){echo "selected";} ?> value="g">гр</option>
        </select><br>

        <label for="description">Описание</label><br>
        <textarea rows="4" cols="50" id="description" name="description" form="form"><?php if(isset($_SESSION['add_data'])){echo $_SESSION['add_data'][6];} ?></textarea><br>
        
        <label for="newPicture">Снимка:</label><br>
        <img id="picture" src="" alt="picture" width="400px" height="300px" style="display:none;"><br>

        <input type="file" id="file" name="file" accept="image/*"><br><br>

        <input type="submit" value="Добавяне">
    </form>
    <?php 
    if(isset($_SESSION['add_data'])){
        unset($_SESSION['add_data']);
    } ?>
</body>

<script type="text/javascript">
    const file = document.querySelector("#file");
    file.addEventListener("change", function(e){
        const file = e.target.files[0]; 
        const url = URL.createObjectURL(file);
        document.querySelector("#picture").src = url;
        if(document.querySelector("#picture").style.display == "none"){
            document.querySelector("#picture").style.display = "inline";
        }
    });
</script>
</html>