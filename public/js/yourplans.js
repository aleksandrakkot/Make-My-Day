const yoursPlansResultDivs = document.querySelectorAll(".your-plan-result-divs")
const yourPlansButtons = document.querySelectorAll(".your-plans-buttons")
const plansDiv = document.querySelectorAll(".go-to-dayplan")
const deletePublishButtons = document.querySelectorAll(".plan-action-buttons")

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

function handleActionPlan(e) {
    const planId = e.target.parentElement.getAttribute("id")


    e.target.getAttribute("id") === "delete_btn" ? deletePlan(planId) : publishPlan(planId)
}

function publishPlan(planId) {
    alert('Are you sure you want to publish your plan?')
    fetch(`/publishPlan/${planId}`).then(function () {
    }).then(function (response) {
        return response.json();
    });
}

function deletePlan(planId) {
    alert('Are you sure you want to delete your plan?')
    fetch(`/deletePlan/${planId}`).then(function () {
    }).then(function (response) {
        return response.json();
    });
}

deletePublishButtons.forEach(btn => {
    btn.addEventListener("click", e => {
        handleActionPlan(e)
    })
})

