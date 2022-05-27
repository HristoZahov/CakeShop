<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $id = $_GET['id'];

        $id = htmlspecialchars( $id, ENT_QUOTES );
        
        $servername = "localhost";
        $database = "cakeshopdb";
        $username = "root";
        $password = "";

        try {

            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
            $stmt = $conn->prepare("SELECT * FROM cakeshopdb.product WHERE Id = ?;");
            $stmt->execute([$id]);
      
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $data = $stmt->fetchAll();
    ?>
    <form action="editProcces.php" id="form" method="get">
        <label for="name">Име</label><br>
        <input type="text" name="name" id="name" value="<?php echo $data[0]['Name']?>"><br>
        
        <label for="price">Цена</label><br>
        <input type="text" name="price" id="price" value="<?php echo $data[0]['Price']?>"><br>

        <label for="type">Тип</label><br>
        <input type="text" name="type" id="type" value="<?php echo $data[0]['Type']?>"><br>

        <label for="pieces">Парчета</label><br>
        <input type="number" name="pieces" id="pieces" value="<?php echo $data[0]['Pieces']?>"><br>

        <label for="description">Описание</label><br>
        <textarea rows="4" cols="50" id="description" name="description" form="form"><?php echo $data[0]['Description']?></textarea><br>
        
        <label for="name">Снимка:</label><br>
        <img src="../Pictures/Products/<?php echo $data[0]['Picture_Name']; ?>" alt="picture" width="400px" height="300px"><br>
        <input type="file" accept="image/*" name="picture" value="../Pictures/Products/<?php echo $data[0]['Picture_Name']; ?>"><br>

        <input type="submit" value="Редактиране">
    </form>
    <?php
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    ?>
</body>
</html>