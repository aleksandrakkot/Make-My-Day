const search = document.querySelector('input[name="browser"]')
const planContainer = document.querySelector('.search-results');
const a = document.querySelector('.go-to-dayplan')

search.addEventListener("keyup",function (e){
    if(e.key === "Enter"){
        e.preventDefault();
        console.log(search.value)

        const data = {search: this.value}

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
            loadPlans(plans);
        })
    }
})

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

    planContainer.appendChild(clone);
}