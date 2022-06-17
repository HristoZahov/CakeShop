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
        <th>Парчета</th>
        <th>Описание</th>
        <th>Снимка</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
        include '../../PHPUtilities/Connection.php';
        include '../../PHPUtilities/Product.php';
        $data = getAllProducts();
        foreach ($data as $key => $value) {
          ?>
          <tr>
            <td class="col-1"><?php echo $value['Id']; ?></td>
            <td class="col-2"><?php echo $value['Name']; ?></td>
            <td class="col-3"><?php echo $value['Price']; ?> лв.</td>
            <td class="col-4"><?php echo $value['Type']; ?></td>
            <td class="col-5"><?php echo $value['Pieces']; ?></td>
            <td class="col-6"><?php echo $value['Description']; ?></td>
            <td class="col-7"><img src="../../Pictures/Products/<?php echo $value['Picture']; ?>" alt="picture" width="200px" height="100px"></td>
            <td class="col-8"><a href="Procces/delete.php?id=<?php echo $value['Id']; ?>">Delete</a></td>
            <td class="col-9"><a href="EditProduct.php?id=<?php echo $value['Id']; ?>">Edit</a></td>
          </tr>
          <?php
        }
      ?>
    </tbody>
  </table>
</body>
</html>