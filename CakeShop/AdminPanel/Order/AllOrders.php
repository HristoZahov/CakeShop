<?php
$statuses = get_orders_statuses();
if(isset($_POST["orders"])){
    if($_POST["orders"] != 0){
        $orders = get_searched_orders($_POST["orders"]);
    }else{
        $orders = get_all_orders();
    }
    $_SESSION["Back"] = "orders";
}else{
    $orders = get_all_orders();
}
?>
<div class="orders not_visible">
    <label for="search_orders">Търсачка:</label>
    <input type="text" id="search_orders" autocomplete="off" onkeyup="search('search_orders','orders')">
    <form class="d-inline" action="" method="post">
        <select name="orders" onchange="form.submit();">
            <option value="0">Всички</option>
            <?php
            foreach ($statuses as $status) {?>
                <option value="<?php echo $status->get_id();?>" <?php 
                if(isset($_POST["orders"])){
                    if($status->get_id() == $_POST["orders"]){
                        echo "selected";
                    }
                }?>>
                    <?php echo $status->get_name();?>
                </option>
            <?php
            }?>
        </select>
    </form>
    <table id="orders">
        <thead>
            <tr>
                <th>Номер</th>
                <th>Потребител</th>
                <th>Адрес</th>
                <th>Дата</th>
                <th>Цена</th>
                <th>Информация</th>
                <th>Статус</th>
            </tr>
        </thead>
    <?php
    foreach (array_reverse($orders) as $key=>$value) {
        ?>
        <tr id="order<?php echo $value['Id']; ?>">
            <td><?php echo $value['Id']; ?></td>
            <td><?php echo $value['Name']." ".$value['Surname']; ?></td>
            <td><?php echo $value['Address']; ?></td>
            <td><?php echo $value['Date']; ?></td>
            <td><?php echo $value['All_Price']; ?> лв.</td>
            <td><?php echo $value['Description']; ?></td>
            <td><select onchange="change_order_status(event,<?php echo $value['Id']; ?>)"><?php
                foreach ($statuses as $status) {?>
                    <option value="<?php echo $status->get_id();?>" <?php
                    if($status->get_id() == $value["Status_Id"]){
                        echo "selected";
                    }
                    ?>><?php echo $status->get_name();?></option>
                <?php
                }?>
            </select></td>
            <td>
                <button class="btn btn-info" onclick="window.location.href = 'Order/SeeOrder.php?Id=<?php echo $value['Id']; ?>'">
                    <i class="fa-sharp fa-solid fa-circle-info"></i>
                </button>
                <button class="btn btn-danger" onclick="delete_ap('order','Order/',<?php echo $value['Id']; ?>)">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </td>
        </tr>
        <?php
    }
    ?>
    </table>
</div>