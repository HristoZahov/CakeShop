<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/styleTable.css?<?php echo time;?>">
</head>
<body>
  <h1>Продукти</h1>
  
  <?php 
    $servername = "localhost";
    $database = "cakeshopdb";
    $username = "root";
    $password = "";
    
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $stmt = $conn->prepare("SELECT * FROM cakeshopdb.product");
      $stmt->execute();

      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $data = $stmt->fetchAll();
      ?>
  <table border="1px">
    <thead>
      <tr>
        <th>Id</th>
        <th>Име</th>
        <th>Цена</th>
        <th>Тип</th>
        <th>Парчета</th>
        <th>Описание</th>
        <th>Снимка</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
          foreach ($data as $key => $value) {
            ?>
            <tr>
              <td><?php echo $value['Id']; ?></td>
              <td><?php echo $value['Name']; ?></td>
              <td><?php echo $value['Price']; ?></td>
              <td><?php echo $value['Type']; ?></td>
              <td><?php echo $value['Pieces']; ?></td>
              <td><?php echo $value['Description']; ?></td>
              <td><img src="../Pictures/Products/<?php echo $value['Picture_Name']; ?>" alt="picture" width="200px" height="100px"></td>
              <td><a href="deleteProduct.php?id=<?php echo $value['Id']; ?>">Delete</a></td>
              <td><a href="editProduct.php?id=<?php echo $value['Id']; ?>">Edit</a></td>
            </tr>
            <?php
          }
        } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }
      ?>
    </tbody>
  </table>
</body>
</html>