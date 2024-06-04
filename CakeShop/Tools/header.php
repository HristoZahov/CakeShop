<?php 
    session_start();
    require_once($paths->get_user());
    require_once($paths->get_database());
    require_once($paths->get_product_utilities());
    require_once($paths->get_universal());

    require_once($paths->get_links());
    require_once($paths->get_basket_utilities());
    require_once($paths->get_basket_utilities());
    require_once($paths->get_product());
    $_SESSION["basket_img_path"] = $paths->get_picture();
    $_SESSION["path"] = $paths->get_path();
?>
<!-- CSS -->
<link rel="stylesheet" href="<?php echo $paths->get_css();echo time();?>">
<!-- background-azttachment: fixed;background-position: center;background-size: cover; -->
<!-- Logo -->
<header class="text-center">
    <a href="<?php echo $paths->get_main_page();?>" class="d-inline-block">
        <h1 class="text-head">Delight</h1>
    </a>
</header>
<!-- Sticky -->
<nav class="position-sticky top-0 nav">
    <!-- Navigation bar -->
    <div class="head-butons text-center overflow-auto">
        <!-- Categoty btn -->
        <div class="category-menu float-start">
            <button id="category-btn"><i class="fa-solid fa-bars"></i><h4>Категории</h4></button>
            <ul class="type position-absolute list-unstyled under-nav-div">
                <form action="<?php echo $paths->get_main_page();?>" method="post">
                <?php
                    $categories = getAllCategories();
                    foreach($categories as $category){
                        ?>
                            <li><input type="submit" name="category" value="<?php echo $category->get_name();?>"></li>
                        <?php
                    }
                ?>
                </form>
            </ul>
        </div>
        <!-- Search btn for mobile-->
        <div class="search-phone float-start ">
            <button id="serch-btn-phone"><i class="fa-solid fa-magnifying-glass"></i></button>
            <div action="<?php echo $paths->get_main_page(); ?>" class="position-absolute under-nav-div" id="search-phone">
                <form class="d-flex justify-content-center" method="post">
                    <input type="text" name="search" id="search-field-phone" autocomplete="off">
                    <button type="submit" id="search-btn-phone"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>
        <!-- Search btn for computer/tablet-->
        <div class="search-desk">
            <form action="<?php echo $paths->get_main_page(); ?>" class="search-desk-form d-flex justify-content-center position-relative" method="post">
                <input type="text" name="search" id="search-field-desk" autocomplete="off">
                <button type="submit" id="search-btn-desk"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        <!-- Basket btn -->
        <div class="float-end">
            <button id="basket_btn"><i class="fa-solid fa-cart-shopping"></i></button>
            <div id="basket" class="position-absolute under-nav-div text-start">
                <?php show_basket();?>
            </div>
        </div>
        <!-- User btn -->
        <div class="user float-end">
            <button id="user-btn"><i class="fa-solid fa-user"></i></button>
            <div class="user-form position-absolute under-nav-div">
                <form class="text-center" action="<?php echo $paths->get_login_nav();?>LoginCheck.php" method="post">
                    <!-- Header -->
                    <h4>Вход</h4>
                    <!-- Email -->
                    <input type="email" name="email" placeholder="E-Mail адрес"><br>
                    <!-- Password -->
                    <div class="position-relative">
                        <input type="password" name="password" id="password" placeholder="Парола">
                        <i id="togglePassword" class="fa-solid fa-eye-slash eye-position"></i>
                    </div>
                    <!-- Buttons -->
                    <input type="submit" value="Вход">
                    <input type="button" onclick="window.location.href='<?php echo $paths->get_login_nav();?>Register.php'" value="Нова регистрация">
                </form>
            </div>
            <div class="user-menu position-absolute p-2 under-nav-div" >
                <form>
                    <h5><?php 
                    if (isset($_SESSION['User'])) {
                        $user = unserialize($_SESSION['User']);
                        echo $user->get_name() . " " . $user->get_surname();
                    }
                    ?></h5>
                    <button onclick="exit('<?php echo $paths->get_path();?>');return false"><i class="fa-solid fa-right-from-bracket"></i>Изход</button>
                </form>
                <ul class="list-unstyled p-0 mb-0">
                    <li><a href="<?php echo $paths->get_path(); ?>Shop/User Menu/UserMenu.php"><i class="fa-solid fa-house">Профил</i></a></li>
                    <li><a href="<?php echo $paths->get_path(); ?>Shop/User Menu/OrderMenu.php"><i class="fa-solid fa-check">Поръчки</i></a></li>
                </ul>
            </div>
        </div>
        <!-- Contacts btn -->
        <button class="float-end" onclick="window.location.href = '<?php echo $paths->get_path(); ?>Shop/Contacts.php'"><i class="fa-solid fa-address-card"></i></button> <!-- <i aria-hidden="true" class="fa fa-map-marker">Контакти</i> -->
    </div>
</nav>
<script src="<?php echo $paths->get_headJs();?>"></script>
<script src="<?php echo $paths->get_loginJs();?>"></script>
<script src="<?php echo $paths->get_basketJs();?>"></script>
<script>
    togglePassword("togglePassword","password")
    let isLogin = "<?php echo isset($_SESSION['User'])?1:0;?>";
    let path = "<?php echo $paths->get_update(); ?>";
    categoryMenuMove()
    searchMenuMove()
    searchEnter()
    basketMove()
    userMenuMove(isLogin)
    clear_data_on_exit(isLogin,"<?= $paths->get_path(); ?>")
</script>
