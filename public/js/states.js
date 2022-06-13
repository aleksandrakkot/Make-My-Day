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
            console.log('usuwanie')
            handlePlan(planId,'-1')
            break
        case "publish_btn":
            handlePlan(planId,'2')
            break
        case "reject_btn":
            handlePlan(planId,'0')
            break
        case "unpublish_btn":
            handlePlan(planId,'0')
            break
        case "approve_btn":
            handlePlan(planId,'1')
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


    if(likesContainer.length === 0 ) return;
        likesContainer.forEach((c)=> c.querySelector("h4").addEventListener("click", (e)=>{
        e.preventDefault();
        e.target.parentElement.querySelector("svg").classList.toggle("favourited");
        changeStats(e.target,'h4')
    }));
    likesContainer.forEach((c)=> c.querySelector("svg").addEventListener("click", (e)=>{
        e.preventDefault();
        e.target.parentElement.classList.toggle("favourited");
        changeStats(e.target,'svg')
    }));
}

function changeStats(e,what) {

    let parent = e.parentElement.parentElement.parentElement.parentElement
    let svg
    let number_h4
    let dayPlan

    if(what === 'svg'){
        parent=parent.parentElement
        number_h4=e.parentElement.previousElementSibling
        svg = e.parentElement
        dayPlan = e.parentElement.parentElement.getAttribute("id")
    }else{
        number_h4=e
        dayPlan = e.parentElement.getAttribute("id")
        svg = e.nextElementSibling
    }

    console.log(dayPlan)
    let id
    if(dayPlan === 'heartInDayPlan'){
        id = window.location.href.split('/').at(-1)
    }else{
        id = (parent.getAttribute("href")).split('/').at(-1)
    }


    if (svg.classList.contains("favourited")){
        const data = {
            id: id,
            bool: true
        }
        console.log('contains fav');
        fetch("/heart", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function () {
            console.log(1);
            number_h4.innerHTML = parseInt(number_h4.innerHTML) + 1;
        })
    } else {
        const data = {
            id: id,
            bool: false
        }
        fetch("/heart", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function () {
            console.log(0);
            number_h4.innerHTML = parseInt(number_h4.innerHTML) - 1;
        })
    }
}



deletePublishButtons.forEach(btn => {
    btn.addEventListener("click", e => {
        handleActionPlan(e)
    })
})

preventLoadOnAction();
preventLoadOnFavourite();