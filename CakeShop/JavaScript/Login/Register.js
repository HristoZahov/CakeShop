focusPassword()

// See requirements for password
function focusPassword(){
    const requirements = document.getElementById('requirements')
    const password = document.getElementById('reg_password')
    password.addEventListener('focus',function(){
        requirements.style.display = 'block'
    })
    password.addEventListener('focusout', function(){
        requirements.style.display = 'none'
    })
    password.onkeyup = function(){
        checkPassword()
    }
    password.onkeydown = function(){
        checkPassword()
    }
}

// Requirements for password
function checkPassword(){
    let password = document.getElementById('reg_password').value

    let lenghtReg = /.{8,}/
    let upperCaseReg = /[A-Z]/
    let lowerCaseReg = /[a-z]/
    let numberReg = /[0-9]/

    checkRegex(password,lenghtReg,"lenght")
    checkRegex(password,upperCaseReg,"upperCase")
    checkRegex(password,lowerCaseReg,"lowerCase")
    checkRegex(password,numberReg,"number")
}

function checkRegex(password, regex, id){
    password.match(regex)?correct(id):wrong(id)
}

function correct(id){
    let element = document.getElementById(id)
    element.style.color = "green"
    element.children[0].classList.remove("fa-x")
    element.children[0].classList.add("fa-check")
}

function wrong(id){
    let element = document.getElementById(id)
    element.style.color = "red"
    element.children[0].classList.remove("fa-check")
    element.children[0].classList.add("fa-x")
}        