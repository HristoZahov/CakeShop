// See password
function togglePassword(eye_id, field_id){
    const eye = document.getElementById(eye_id)
    eye.addEventListener("click",function(){
        const password = document.getElementById(field_id)
        let type = password.getAttribute("type") === "text" ? "password":"text"

        password.setAttribute("type", type)
        this.classList.toggle("fa-eye")
    })
}