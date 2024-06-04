const navbar = document.getElementById("navbar")

const nav_products = navbar.children[0]
const nav_categories = navbar.children[1] 
const nav_orders = navbar.children[2]
const nav_users = navbar.children[3] 

const products = document.getElementsByClassName("products")[0]
const categories = document.getElementsByClassName("categories")[0]
const orders = document.getElementsByClassName("orders")[0]
const users = document.getElementsByClassName("users")[0]

nav_products.onclick = function(){
   jQuery.ajax({url: "ChangeVisible.php?change=products"})
   products.classList.remove("not_visible")
   categories.classList.add("not_visible")
   users.classList.add("not_visible")
   orders.classList.add("not_visible")
}

nav_categories.onclick = function(){
    jQuery.ajax({url: "ChangeVisible.php?change=categories"})
    products.classList.add("not_visible")
    categories.classList.remove("not_visible")
    users.classList.add("not_visible")
    orders.classList.add("not_visible")
}

nav_users.onclick = function(){
    jQuery.ajax({url: "ChangeVisible.php?change=users"})
    users.classList.remove("not_visible")
    products.classList.add("not_visible")
    categories.classList.add("not_visible")
    orders.classList.add("not_visible")
}

nav_orders.onclick = function(){
    jQuery.ajax({url: "ChangeVisible.php?change=orders"})
    orders.classList.remove("not_visible")
    users.classList.add("not_visible")
    products.classList.add("not_visible")
    categories.classList.add("not_visible")
}

function update_visible(visible){
    switch (visible) {
        case "categories":
            categories.classList.remove("not_visible")
            break;
        case "users":
            users.classList.remove("not_visible")
            break;
        case "orders":
            orders.classList.remove("not_visible")
            break;
        default:
            products.classList.remove("not_visible")
            break;
    }
}

function delete_ap(type,folder,id){
    jQuery.ajax({url: folder + "Process/delete.php?Id=" + id,success: function(result){
        $("#info").html(result)
        let info = document.getElementById("info")
        if(info.children.length == 0){
            let el = document.getElementById(type+id)
            el.style.display = "none";
        }
    }})
}

function change_status(event,id){
    let button = event.target

    if(button.innerHTML == "Видим"){
        button.classList.remove("btn-success")
        button.classList.add("btn-danger")
        button.innerHTML = "Невидим"
        button.parentElement.parentElement.style.background = "cyan"

        jQuery.ajax({url: "Product/UpdateStatus.php?Id=" + id + "&Status=2"})
    }else if("Невидим"){
        button.classList.remove("btn-danger")
        button.classList.add("btn-success")
        button.innerHTML = "Видим"
        button.parentElement.parentElement.style.background = "pink"

        jQuery.ajax({url: "Product/UpdateStatus.php?Id=" + id + "&Status=1"})
    }
}

function change_user_type(event,id){
    let type = event.target.value
    jQuery.ajax({url: "User/ChangeType.php?Id=" + id + "&Type=" + type})
}

function search(input_id,table_id) {
    let input, filter, table, tr;
    input = document.getElementById(input_id);
    filter = input.value.toUpperCase();
    table = document.getElementById(table_id);
    tr = table.getElementsByTagName("tr");

    for (let i = 1; i < tr.length; i++) {
        let tds = tr[i].getElementsByTagName("td");
        let flag = false;

        for(let j = 0; j < tds.length; j++){
            let td = tds[j];
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                flag = true;
                tr[i].style.display = "";
                break;
            } 
        }
        if(!flag){
            tr[i].style.display = "none";
        }
    }
}

function change_order_status(event,id){
    let status = event.target.value

    jQuery.ajax({url: "Order/UpdateStatus.php?Id=" + id + "&Status=" + status})
}

function exit(path) {
    jQuery.ajax({url: path + "PHP/User/Exit.php",success: function(result){
        $("#basket").html(result)
        location.reload()
    }})
}