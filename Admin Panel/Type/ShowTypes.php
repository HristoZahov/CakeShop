<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Types</title>
</head>
<body>
   <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Име</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../../PHPUtilities/Type.php';

            $types = getAllTypes();

            foreach ($types as $key => $value) {
            ?>
            <tr>
                <td><?php echo $value['Id'];?></td>
                <td><?php echo $value['Type'];?></td>
            </tr>
            <?php
            }
            ?>
            <tr></tr>
        </tbody>
   </table> 
</body>
</html>