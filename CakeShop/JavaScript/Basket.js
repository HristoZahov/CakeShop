let basket_name = "basket";
let count,basket;

if(getCookie(basket_name) == null)
    setCookie(basket_name,JSON.stringify({}),20)
// else
//     deleteCookie(basket_name)

// Add
function add_to_cart(product_id){
    if(document.getElementById("count") != null){
        count = parseInt(document.getElementById("count").value);
    }else{
        count = 1;
    }
    basket = JSON.parse(decodeURIComponent(getCookie(basket_name)))
    add_item_in_cookie(product_id,count,basket)

    // alert("Продуктът е добавен")
    // console.log(getCookie(basket_name));
}

function add_item_in_cookie(product_id,count,basket){
    if(product_id in basket){
        count += basket[product_id]
        if(count > 20){
            count = 20;
        }
        basket[product_id] = count
        setCookie(basket_name,JSON.stringify(basket),20)
        jQuery.ajax({url: path + product_id + "&Method=update",success: function(result){
            $("#basket").html(result)
        }})
    }else{
        basket[product_id] = count
        setCookie(basket_name,JSON.stringify(basket),20)
        jQuery.ajax({url: path + product_id + "&Method=add",success: function(result){
            $("#basket").html(result)
        }})
    }
}

// Delete
function delete_item_in_cart(product_id){
    basket = JSON.parse(decodeURIComponent(getCookie(basket_name)))
    delete_item_in_cookie(product_id)

    // console.log(getCookie(basket_name));
}

function delete_item_in_cookie(product_id){
    delete basket[product_id]
    setCookie(basket_name,JSON.stringify(basket),20)
    jQuery.ajax({url: path + product_id + "&Method=delete",success: function(result){
        $("#basket").html(result)
    }})
}

// Edit
function edit_cart(event,product_id){
    count = parseInt(event.target.value);
    basket = JSON.parse(decodeURIComponent(getCookie(basket_name)))
    edit_item_cookie(product_id,count,basket)

    let order = document.getElementById("order")
    if(order != null){
        jQuery.ajax({url: "RefreshPageBasket.php",success: function(result){
            $("#page_basket").html(result)
        }})
    }
    // console.log(getCookie(basket_name));
}

function edit_item_cookie(product_id,count,basket){
    basket[product_id] = count
    setCookie(basket_name,JSON.stringify(basket),20)
    jQuery.ajax({url: path + product_id + "&Method=update",success: function(result){
        $("#basket").html(result)
    }})
}

function clear_cart(){
    setCookie(basket_name,JSON.stringify({}),20)
    jQuery.ajax({url: path + "&Method=clear",success: function(result){
        $("#basket").html(result)
    }})
    // console.log(getCookie(basket_name));
}

function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function deleteCookie(name) {   
    document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}