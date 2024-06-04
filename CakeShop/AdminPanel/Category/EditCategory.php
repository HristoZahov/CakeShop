<?php
    include_once("../../Tools/Links.html");
    include_once("../../PHP/DataBase.php");
    include_once("../../PHP/Universal/Universal.php");
    include_once("../../PHP/Universal/Utilities.php");
    session_start();

    if(!isset($_SESSION['Admin'])){
        header("location: ../../");
    }

    $_SESSION["Back"] = "categories";
    $id = $_GET['Id'];
    $category = get_one_category($id);
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
                <td><input type="text" name="name" id="name" autocomplete="off" value="<?php echo $category->get_name();?>" required></td>
            </tr>

            <tr>
                <td colspan="2" class="text-center"><input class="exit"type="submit" value="Редактиране"></td>
            </tr>
        </form>
    </table>
</body>
<script src="../../JavaScript/AdminPanel/Add_Edit.js"></script>
</html>