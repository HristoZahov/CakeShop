const lis = document.querySelectorAll("li")
for (let i = 0; i < lis.length - 1; i++) {
    const element = lis[i];
    element.onclick = function(){
        switch(i){
            case 0:
                jQuery.ajax({url: "../ChangeVisible.php?change=products"})
                break
            case 1:
                jQuery.ajax({url: "../ChangeVisible.php?change=categories"})
                break
            case 2:
                jQuery.ajax({url: "../ChangeVisible.php?change=orders"})
                break
            case 3:
                jQuery.ajax({url: "../ChangeVisible.php?change=users"})
                break
        }
        window.location.href = "../AdminPanel.php"
    }
}

function exit(path) {
    jQuery.ajax({url: path + "PHP/User/Exit.php",success: function(result){
        $("#basket").html(result)
        location.reload()
    }})
}