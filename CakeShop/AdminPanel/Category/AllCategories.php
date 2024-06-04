<div class="categories not_visible">
    <label for="search_categories">Търсачка:</label>
    <input type="text" id="search_categories" autocomplete="off" onkeyup="search('search_categories','categories')">
    <form action="Category/Process/add.php" method="post">
        <input type="text" id="category" name="category" autocomplete="off">
        <button class="btn btn-primary">Добави</button>
    </form>
    <table id="categories">
        <thead>
            <tr>
                <th>№</th>
                <th>Име</th>
            </tr>
        </thead>
    <?php
    $categories = getAllCategories();
    foreach (array_reverse($categories) as $category) {
        ?>
        <tr id="category<?php echo $category->get_id(); ?>">
            <td><?php echo $category->get_id(); ?></td>
            <td><?php echo $category->get_name(); ?></td>
            <td>
                <button class="btn btn-warning" onclick="window.location.href = 'Category/EditCategory.php?Id=<?php echo $category->get_id(); ?>'">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <button class="btn btn-danger" onclick="delete_ap('category','Category/',<?php echo $category->get_id(); ?>)">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php
        if(isset($_SESSION['Add_Success'])){
            echo "<script>window.onload = function(){alert('Успешно добавяне')}</script>";
            unset($_SESSION['Add_Success']);
        }
        if(isset($_SESSION['Edit_Success'])){
            echo "<script>window.onload = function(){alert('Успешно редактиране')}</script>";
            unset($_SESSION['Edit_Success']);
        }
    ?>
</div>