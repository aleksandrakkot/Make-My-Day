const milestoneContainer = document.querySelector(".plan-steps");

const fetchMilestones = () => {
    const planId = window.location.href.split('/').at(-1);

    const data = {
        id: planId
    };

    fetch("/milestone", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then(function (milestones) {
        loadMilestones(milestones);
    });
}

const loadMilestones = (milestones) => {
    let i = 1;
    milestones.forEach(m => createMilestone(m, i++));
};

const createMilestone = (milestone, num) => {
    const template = document.querySelector('#plan-milestone');

    const clone = template.content.cloneNode(true);

    const step = clone.querySelector("#number-of-step");
    step.textContent = num;

    const time = clone.querySelector("#time")
    const startSplit =  milestone.milestone_start_time.split(":");
    const endSplit =  milestone.milestone_end_time.split(":");
    time.textContent = startSplit[0] + "." + startSplit[1] + "-" + endSplit[0] + "." + endSplit[1];

    const name = clone.querySelector("#step-name");
    name.textContent = milestone.location_name;

    const location = clone.querySelector("#street");

    try{
        location.textContent = milestone.street_name.split(":") + " " + milestone.street_number;
    }catch(e){

    }

    const desc = clone.querySelector("#description");
    desc.textContent = milestone.milestone_description;

    const image = clone.querySelector("#step-photo");

    if(milestone.image !== null){
        image.src = `public/uploads/${milestone.image}`;
    }else {
        image.parentElement.removeChild(image);
    }

    milestoneContainer.appendChild(clone);
}

fetchMilestones();