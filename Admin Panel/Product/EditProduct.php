<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit product</title>
</head>
<body>
    <a href="ShowProducts.php">Назад</a>
    <?php
        include_once '../../PHPUtilities/Product.php';
        include_once '../../PHPUtilities/Type.php';
        include_once '../../PHPUtilities/Utilities.php';
        session_start();

        $id = $_GET['id'];
        $_SESSION['id'] = $id;

        $id = htmlspecialchars( $id, ENT_QUOTES );

       $data = getOneProduct($id);
       $types = getAllTypes();
   
        if(isset($_SESSION['edit_error'])){
            $error = $_SESSION['edit_error'];
            foreach ($error as $key => $value) {
                ?>
                <p><?php echo $value; ?></p>
                <?php
            }
            unset($_SESSION['edit_error']);
        }
    ?>
    <form id="form" action="Procces/edit.php" method="post" enctype="multipart/form-data">
        <label for="name">Име</label><br>
        <input type="text" name="name" id="name" value="<?php echo $data['Name']?>"><br>
        
        <label for="price">Цена</label><br>
        <input type="text" name="price" id="price" value="<?php echo $data['Price']?>"><br>

        <label for="type">Тип</label><br>
        <select id="type" name="type">
            <option value="">Изберете</option>
            <?php
            foreach ($types as $key => $value) {
            ?>
            <option <?php if($data['Type'] == $value['Type']){echo "selected";} ?> value="<?php echo $value['Type']; ?>"><?php echo $value['Type']; ?></option>
            <?php
            }
            ?>
        </select><br>

        <label for="pieces">Парчета</label><br>
        <input type="number" name="pieces" id="pieces" value="<?php echo $data['Pieces']?>"><br>

        <label for="weight">Тегло</label><br>
        <input type="number" name="weight" step="any" id="weight" value="<?php echo weightFilter($data['Weight']) ?>">
        <select id="measurement" name="measurement">
            <option <?php if($data['Measurement'] == "kg"){echo "selected";} ?> value="kg">кг</option>
            <option <?php if($data['Measurement'] == "g"){echo "selected";} ?> value="g">гр</option>
        </select><br>

        <label for="description">Описание</label><br>
        <textarea rows="4" cols="50" id="description" name="description" form="form"><?php echo $data['Description']?></textarea><br>
        
        <label for="newPicture">Снимка:</label><br>
        <img id="picture" src="../../Pictures/Products/<?php echo $data['Picture']; ?>" alt="picture" width="400px" height="300px"><br>

        <input type="file" id="file" name="file" accept="image/*"><br><br>

        <input type="submit" value="Редактиране">
    </form>
    <script type="text/javascript">
        const file = document.querySelector("#file");
        file.addEventListener("change", function(e){
            const file = e.target.files[0]; 
            const url = URL.createObjectURL(file);
            document.querySelector("#picture").src = url;

        });
    </script>
</body>
</html>