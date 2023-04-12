
console.log("mohamed");


// TODO: Start Function Used To Hide Div When You Click.
function displayDiv(val) {
    if (val === "hide") {
        document.getElementById('choose-display').style.display='none';
    } else {
        document.getElementById('choose-display').style.display='block';
    }
}
// TODO: End Function Used To Hide Div When You Click.


// TODO: Start Script Button To Close The Message.
let itemMessage = document.querySelectorAll(".items-message");
let iconMessage = Array.from(document.querySelectorAll(".icon-mess-2"));
iconMessage.forEach((btn) => {
    btn.onclick = () => {
        let index = iconMessage.indexOf(btn);
        itemMessage[index].style.display = "none";
    }
});
// TODO: End Script Button To Close The Message.


// TODO: Start Validation Form Login.
let fields = Array.from(document.querySelectorAll(".fields-valid"));
let messageValid = Array.from(document.querySelectorAll(".input-message-valid"));
let inputEmailLogin = document.querySelector(".email-input");
let inputPassLogin = document.querySelector(".pass-input");
let buttonLogin = document.querySelector(".button-login");
messageValid[0].style.display = "none";
messageValid[1].style.display = "none";
fields.forEach((e) => {
    e.addEventListener("keyup", () => {
        if (inputEmailLogin.value != "" && inputPassLogin.value != "") {
            buttonLogin.disabled = false;
            buttonLogin.style.opacity = "1";
        }else {
            buttonLogin.disabled = true;
            buttonLogin.style.opacity = "0.5";
        }
        if (inputEmailLogin.value == "") {
            fields[0].style.border = "2px solid #FF1E56";
            messageValid[0].style.display = "block";
        }else {
            fields[0].style.border = "2px solid #25c669";
            messageValid[0].style.display = "none";
        }
        if(inputPassLogin.value == "") {
            fields[1].style.border = "2px solid #FF1E56";
            messageValid[1].style.display = "block";
        }else {
            fields[1].style.border = "2px solid #25c669";
            messageValid[1].style.display = "none";
        }
    })
});
// TODO: End Validation Form Login.