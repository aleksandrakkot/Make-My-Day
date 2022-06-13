const deletePublishButtons = document.querySelectorAll(".plan-action-buttons")

function handlePlan(planId, number) {
    const data = {
        id: planId,
        state_flag: number
    };

    fetch("/handlePlan", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        location.reload();
        return response.json();
    })

}

function handleActionPlan(e) {
    const planId = e.target.parentElement.getAttribute("id")

    switch (e.target.getAttribute("id")){
        case "delete_btn":
            handlePlan(planId,-1)
            break
        case "publish_btn":
            handlePlan(planId,2)
            break
        case "reject_btn":
            handlePlan(planId,0)
            break
        case "unpublish_btn":
            handlePlan(planId,0)
            break
        case "approve_btn":
            handlePlan(planId,1)
            break
        default:
            alert("zla nazwa przycisku!")
            break
    }
}

function preventLoadOnAction() {
    if(deletePublishButtons.length == 0) return;
        deletePublishButtons.forEach((elem) => elem.addEventListener("click", (e) => {
        e.preventDefault();
    }));
}

function preventLoadOnFavourite() {
    const likesContainer = document.querySelectorAll(".likes");

    if(likesContainer.length == 0 ) return;
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