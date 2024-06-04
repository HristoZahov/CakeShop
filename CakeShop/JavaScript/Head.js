const menu_btn = document.getElementById('category-btn')
const type = document.getElementsByClassName('type')[0]

const search_btn = document.getElementById('serch-btn-phone')
const search = document.getElementById('search-phone')

const user_btn = document.getElementById('user-btn')
const user_form = document.getElementsByClassName('user-form')[0]
const user_menu = document.getElementsByClassName('user-menu')[0]

const basket_btn = document.getElementById("basket_btn")
const basket_div = document.getElementById("basket")

function categoryMenuMove() {
    menu_btn.onclick = function () {
        let visible = getComputedStyle(type).display == "none" ? "block" : "none"
        let user_form_visible = getComputedStyle(user_form).display
        let user_menu_visible = getComputedStyle(user_menu).display
        let search_visible = getComputedStyle(search).display
        let basket_visible = getComputedStyle(basket_div).display

        if((search_visible == 'block' || user_form_visible == "block" || user_menu_visible == "block" 
        || basket_visible == "block") && visible == 'block'){
            search.style.display = 'none'
            user_form.style.display = 'none'
            user_menu.style.display = 'none'
            basket_div.style.display = 'none'
        }

        type.style.display = visible
    }
}

function searchMenuMove() {
    search_btn.onclick = function () {
        let visible = getComputedStyle(search).display == "none" ? "block" : "none"
        let user_form_visible = getComputedStyle(user_form).display
        let user_menu_visible = getComputedStyle(user_menu).display
        let type_visible = getComputedStyle(type).display
        let basket_visible = getComputedStyle(basket_div).display

        if((type_visible == 'block' || user_form_visible == "block" || user_menu_visible == "block" || basket_visible == "block") && visible == 'block'){
            type.style.display = 'none'
            user_form.style.display = 'none'
            user_menu.style.display = 'none'
            basket_div.style.display = 'none'
        }

        search.style.display = visible
    }
}

function userMenuMove(isLogin) {
    user_btn.onclick = function () {
        if(isLogin == 0)
            userVisible(user_form)
        else
            userVisible(user_menu)
    }
}

function userVisible(element){
    let visible = getComputedStyle(element).display == "none" ? "block" : "none"
    let type_visible = getComputedStyle(type).display
    let search_visible = getComputedStyle(search).display
    let basket_visible = getComputedStyle(basket_div).display

    if((search_visible == 'block' || type_visible == 'block' || basket_visible == "block") && visible == 'block'){
        search.style.display = 'none'
        type.style.display = 'none'
        basket_div.style.display = 'none'
    }

    element.style.display = visible
}

function basketMove(){
    basket_btn.onclick = function () {
        let visible = getComputedStyle(basket_div).display == "none" ? "block" : "none"
        let search_visible = getComputedStyle(search).display
        let user_form_visible = getComputedStyle(user_form).display
        let user_menu_visible = getComputedStyle(user_menu).display
        let type_visible = getComputedStyle(type).display

        if((type_visible == 'block' || user_form_visible == "block" || user_menu_visible == "block" || search_visible == "block") && visible == 'block'){
            type.style.display = 'none'
            user_form.style.display = 'none'
            user_menu.style.display = 'none'
            search.style.display = 'none'
        }

        basket_div.style.display = visible
    }
}

// Serch work whit "Enter" buttom
function searchEnter() {
    let input_desk = document.getElementById("search-field-desk");
    input_desk.addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
            document.getElementById("search-btn-desk").click();
        }
    })

    let input_phone = document.getElementById("search-field-phone");
    input_phone.addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
            document.getElementById("search-btn-phone").click();
        }
    })
}

function exit(path) {
    jQuery.ajax({url: path + "PHP/User/Exit.php",success: function(result){
        $("#basket").html(result)
        location.reload()
    }})
}

function clear_data_on_exit(isLogin,path){
    if(isLogin == 1){
        window.addEventListener("unload", function() {
            setCookie(basket_name,JSON.stringify({}),20)
            exit(path)
        });
    }
}