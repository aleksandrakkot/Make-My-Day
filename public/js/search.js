

const search = document.querySelector('input[name="browser"]')
const planContainer = document.querySelector('.search-results');
const a = document.querySelector('.go-to-dayplan')
const buttonSearch = document.querySelector('#search-btn')

buttonSearch.addEventListener("click",()=>{
    handleSearching()
})

search.addEventListener("keyup", (e) => {
    if(e.key === "Enter"){
        e.preventDefault();
        handleSearching(e)
    }
})

function handleSearching (){

    const efect = search.value.toLowerCase();
    const res = efect.substring(0,1).toUpperCase() + efect.substring(1)

    console.log(res)
    const data = {search: res}

    fetch("/searchPlans",{
        method: "POST",
        headers: {
            'Content-Type' : 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response){
        console.log(response);
        return response.json()
    }).then(function (plans){
        planContainer.innerHTML = ""
        console.log(plans);
        plans.length !== 0 ?  loadPlans(plans) : planContainer.innerHTML = "<p class='plan-info'>No plans for this city...</p>"
    })

}

function loadPlans(plans) {
    plans.forEach(plan => {
        console.log(plan);
        createPlan(plan);
    });
}

function createPlan(p){
    const template = document.querySelector('#plan-template')

    const clone = template.content.cloneNode(true);
    const a = clone.querySelector(".go-to-dayplan");
    a.setAttribute("href", "dayplan/" + p.day_plan_id);

    const plansName = clone.querySelector("#plans-name")
    plansName.innerHTML = p.day_plan_name;

    const image = clone.querySelector("img");
    image.src = `public/uploads/${p.image}`;

    const location = clone.querySelector("#plans-location");
    location.innerHTML = p.city_name;

    const nick = clone.querySelector("#plans-user");
    nick.innerHTML = p.nick;

    const likes = clone.querySelector("#plans-likes");
    likes.innerHTML = p.likes;

    const heart = clone.querySelector("svg")
    console.log(p.is_fav)
    if(p.is_fav === '1'){
        console.log(heart)
        heart.classList.add("favourited")
    }

    const time = clone.querySelector("#plans-time");
    time.innerHTML = p.start + " - " + p.fin;

    planContainer.appendChild(clone);
    preventLoadOnFavourite();
}