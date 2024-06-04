<div class="products not_visible">
    <label for="search_products">Търсачка:</label>
    <input type="text" id="search_products" autocomplete="off" onkeyup="search('search_products','products')">
    <button class="btn btn-primary" onclick="window.location.href = 'Product/AddProduct.php'">Добави</button>
    
    <table id="products">
        <tr>
            <th>№</th>
            <th>Снимка</th>
            <th>Име</th>
            <th>Цена</th>
            <th>Категория</th>
            <th>Парчета</th>
            <th>Тежест</th>
            <th>Описание</th>
            <th>Статус</th>
        </tr>
    <?php
    $products = get_all_products_admin_panel();
    foreach ($products as $product) {
        ?>
        <tr id="product<?php echo $product->get_id(); ?>" style="<?php if($product->get_status_id() == 2){
                echo "background-color: cyan;";
            }?>">
            <td><?php echo $product->get_id(); ?></td>
            <td><img src="../Pictures/Products/<?php echo $product->get_picture(); ?>" alt="Product" width="200px" height="200px"></td>
            <td><?php echo $product->get_name(); ?></td>
            <td><?php echo $product->get_price(); ?> лв.</td>
            <td><?php echo $product->get_category(); ?></td>
            <td><?php echo $product->get_pieces(); ?></td>
            <td><?php echo $product->get_weight() . $product->get_measurement(); ?></td>
            <td><?php echo $product->get_description(); ?></td>
            <td><button onclick="change_status(event,<?php echo $product->get_id(); ?>)" class="btn <?php 
            if($product->get_status_id() == 1){
                echo "btn-success";
            }else{
                echo "btn-danger";
            }
            ?>"><?php echo $product->get_status(); ?></button></td>
            <td>
                <button class="btn btn-warning" onclick="window.location.href = 'Product/EditProduct.php?Id=<?php echo $product->get_id(); ?>'">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <button class="btn btn-danger" onclick="delete_ap('product','Product/',<?php echo $product->get_id(); ?>)">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </td>
        </tr>
        <?php
    }
    ?>
    </table>
</div>