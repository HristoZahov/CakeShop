<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <link rel="stylesheet" href="../../CSS/Admin.css?<?php echo time(); ?>">
</head>
<body>
  <h1>Продукти</h1>
  <a class="add" href="AddProduct.php">Добавяне</a>
  <table>
    <thead>
      <tr>
        <th>Id</th>
        <th>Име</th>
        <th>Цена</th>
        <th>Тип</th>
        <th>Тегло</th>
        <th>Парчета</th>
        <th>Описание</th>
        <th>Снимка</th>
        <th colspan=2></th>
      </tr>
    </thead>
    <tbody>
      <?php
        include '../../PHPUtilities/Connection.php';
        include '../../PHPUtilities/Product.php';
        include '../../PHPUtilities/Utilities.php';
        $data = getAllProducts();
        foreach ($data as $key => $value) {
          ?>
          <tr>
            <td><?php echo $value['Id']; ?></td>
            <td><?php echo $value['Name']; ?></td>
            <td><?php echo $value['Price']; ?> лв.</td>
            <td><?php echo $value['Type']; ?></td>
            <td><?php echo weightFilter($value['Weight']); if($value['Measurement'] == "kg"){ echo " кг";}else{ echo " гр";} ?></td>
            <td><?php echo $value['Pieces']; ?></td>
            <td><?php echo $value['Description']; ?></td>
            <td><img src="../../Pictures/Products/<?php echo $value['Picture']; ?>" alt="picture" width="300px" height="200px"></td>
            <td><a href="Procces/delete.php?id=<?php echo $value['Id']; ?>">Delete</a></td>
            <td><a href="EditProduct.php?id=<?php echo $value['Id']; ?>">Edit</a></td>
          </tr>
          <?php
        }
      ?>
    </tbody>
  </table>
</body>
</html>