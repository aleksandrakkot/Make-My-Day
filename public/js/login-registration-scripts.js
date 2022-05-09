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

const multiStepForm = document.querySelector("[data-multi-step]")
const formSteps = [...multiStepForm.querySelectorAll('[data-step]')]


let currStep = formSteps.findIndex( step => {
    return step.classList.contains("active")
})

if(currStep < 0){
    currStep = 0
    showCurrStep()
}

multiStepForm.addEventListener("click", e => {
    let incre
    if (e.target.matches("[data-next]")){
        incre = 1
        currStep += incre
        console.log(currStep)
    }
    showCurrStep()
})
console.log(currStep)
function showCurrStep() {
    formSteps.forEach((step,index) => {
        step.classList.toggle("active",index === currStep)
    })
}
