
"use strict"

// for show password 
let createpassword = (type, ele) => {
    document.getElementById(type).type = document.getElementById(type).type == "password" ? "text" : "password"
    let icon = ele.childNodes[1].classList
    let stringIcon = icon.toString()
    if (stringIcon.includes("ti-eye-off")) {
        ele.childNodes[1].classList.remove("ti-eye-off")
        ele.childNodes[1].classList.add("ti-eye")
    }
    else {
        ele.childNodes[1].classList.add("ti-eye-off")
        ele.childNodes[1].classList.remove("ti-eye")
    }
}