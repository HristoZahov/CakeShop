<script src="https://kit.fontawesome.com/a6599b17cf.js" crossorigin="anonymous"></script>

<header><a href="Shop.php"><h1 class="text-center text-head">Delight</h1></a></header>
<nav class="sticky">
    <div class="links text-center">
        <button id="lines" class="button float-start"><i class="fa-solid fa-bars"></i></button>
        <button id="btn-search" class="button float-start"><i class="fa-solid fa-magnifying-glass"></i></button>
        <button class="button" <?php if($_SESSION['user'][0]['Privileges'] == 0){echo "hidden";}?>><a href="../Admin Panel/Product/ShowProducts.php"><i class="fa-solid fa-screwdriver-wrench"></i></a></button>
        <button class="button float-end"><a href="../Login/Login.php"><i class="fa-solid fa-user"></a></i></button>
        <button class="button float-end"><a href=""><img src="../Pictures/Icons/Cart.png" alt=""></a></button>
        <button class="button float-end"><a href=""><i class="fa-solid fa-address-book"></i></a></button>
    </div>
    <div style="margin-top: -6px">
        <div id="filter">
            <?php
            $types = getAllTypes();
            foreach ($types as $key => $value) {
            ?>
                <a href="Shop.php?search=<?php echo $value['Type']?>"><?php echo $value['Type']?></a><br>
            <?php
            }
            ?>
        </div>
        <div id="search">
            <form action="Shop.php" method="post">
                <input type="text" name="filter" autocomplete="off">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>
</nav>

<script>
    let lines = document.getElementById('lines');
    lines.addEventListener("click", function(e){
        let href = document.getElementById('filter');
        let filter = document.getElementById('search');
        if(window.getComputedStyle(href).display == "none"){
            href.style.display = 'block';
            href.style.position = 'absolute';
            filter.style.display = 'none';
        }else{
            href.style.display = 'none';
        }
    });

    let search = document.getElementById('btn-search');
    search.addEventListener("click", function(e){
        let filter = document.getElementById('search');
        let href = document.getElementById('filter');
        if(window.getComputedStyle(filter).display == "none"){
            filter.style.display = 'block';
            filter.style.position = 'absolute';
            href.style.display = 'none';
        }else{
            filter.style.display = 'none';
        }
    });
</script> 