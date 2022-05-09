const passwordInput = document.querySelector('input[name="password"]');
const showBtn = document.querySelector(".showBtn");

function showPasswordOrHide () {
    (passwordInput.type === "password") ? passwordInput.type="text" : passwordInput.type="password";
}

passwordInput.addEventListener('keyup', ()=>{
    if(passwordInput.value !== ''){
        showBtn.style.display='block'
        showBtn.addEventListener('click',showPasswordOrHide)
    }else{
        showBtn.style.display='none'
    }
})