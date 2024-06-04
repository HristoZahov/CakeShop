<div class="users not_visible">
    <label for="search_users">Търсачка:</label>
    <input type="text" id="search_users" autocomplete="off" onkeyup="search('search_users','users')">
    <?php 
    $main_user = unserialize($_SESSION['Admin']);
    if($main_user->get_type_id() == 3){?>
    <button class="btn btn-primary" onclick="window.location.href = 'User/AddUser.php'">Добави</button>
    <?php
    }?>
    <table id="users">
        <thead>
            <tr>
                <th>№</th>
                <th>Име</th>
                <th>Фамилия</th>
                <th>Имейл</th>
                <th>Телефон</th>
                <?php 
                if($main_user->get_type_id() == 3){?>
                    <th>Тип</th>
                <?php
                }?>
            </tr>
        </thead>
    <?php

    $users = get_all_users();
    $types = get_all_types();
    foreach (array_reverse($users) as $user) {
        ?>
        <tr id="user<?php echo $user->get_id(); ?>">
            <td><?php echo $user->get_id(); ?></td>
            <td><?php echo $user->get_name(); ?></td>
            <td><?php echo $user->get_surname(); ?></td>
            <td><?php echo $user->get_email(); ?></td>
            <td><?php echo $user->get_phone(); ?></td>
            <?php
            if($main_user->get_type_id() == 3){?>
                <td><select onchange="change_user_type(event,<?php echo $user->get_id(); ?>)"><?php
                    foreach ($types as $type) {?>
                        <option value="<?php echo $type->get_id();?>" <?php
                        if($type->get_id() == $user->get_type_id()){
                            echo "selected";
                        }
                        ?>><?php echo $type->get_name();?></option>
                    <?php
                    }?>
                </select></td>
            <?php
            }?>
            <td>
                <button class="btn btn-warning" onclick="window.location.href = 'User/EditUser.php?Id=<?php echo $user->get_id(); ?>'">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <?php if($main_user->get_type_id() == 3){?>
                <button class="btn btn-danger" onclick="delete_ap('user','User/',<?php echo $user->get_id(); ?>)">
                    <i class="fa-solid fa-trash"></i>
                </button>
                <?php
                }?>
            </td>
        </tr>
        <?php
    }
    ?>
    </table>
</div>