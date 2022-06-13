const yoursPlansResultDivs = document.querySelectorAll(".your-plan-result-divs")
const yourPlansButtons = document.querySelectorAll(".your-plans-buttons")
const plansDiv = document.querySelectorAll(".go-to-dayplan")

function showProperDivsYourPlans(e){
    e.target.classList.add("active")
    yourPlansButtons.forEach((btn)=>{
        if(btn !== e.target && btn.classList.contains("active")){
            btn.classList.remove("active")
        }
    })

    yoursPlansResultDivs.forEach((div)=>{
        if(div.classList.contains(e.target.getAttribute("id"))){
            div.classList.add("active")
        }

        if(!div.classList.contains(e.target.getAttribute("id"))  && div.classList.contains("active")){
            div.classList.remove("active")
        }
    })
}


yourPlansButtons.forEach((btn) =>{
    btn.addEventListener("click", (e) => {
        showProperDivsYourPlans(e)
    })
})


