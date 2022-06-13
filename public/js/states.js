const deletePublishButtons = document.querySelectorAll(".plan-action-buttons")
const likesContainer = document.querySelectorAll(".likes");

function handleActionPlan(e) {
    const planId = e.target.parentElement.getAttribute("id")


    e.target.getAttribute("id") === "delete_btn" ? deletePlan(planId) : publishPlan(planId)
}

function publishPlan(planId) {
    alert('Are you sure you want to publish your plan?')
    fetch(`/publishPlan/${planId}`).then(function () {
    }).then(function (response) {
        location.reload();
        return response.json();
    });
}

function deletePlan(planId) {
    alert('Are you sure you want to delete your plan?')
    fetch(`/deletePlan/${planId}`).then(function () {
    }).then(function (response) {
        location.reload();
        return response.json();
    });
}

function preventLoadOnAction() {
    deletePublishButtons.forEach((elem) => elem.addEventListener("click", (e) => {
        e.preventDefault();
    }));
}

function preventLoadOnFavourite() {
    likesContainer.forEach((c)=> c.querySelector("h4").addEventListener("click", (e)=>{
        e.preventDefault();
        e.target.parentElement.querySelector("svg").classList.toggle("favourited");
    }));
    likesContainer.forEach((c)=> c.querySelector("svg").addEventListener("click", (e)=>{
        e.preventDefault();
        e.target.classList.toggle("favourited");
    }));
}



deletePublishButtons.forEach(btn => {
    btn.addEventListener("click", e => {
        handleActionPlan(e)
    })
})

preventLoadOnAction();
preventLoadOnFavourite();