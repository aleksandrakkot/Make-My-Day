const addNewMilestoneButton = document.querySelector("#add-next-milestone")
const stepsFormContainer = document.querySelector(".plan-steps")
const template_milestone = document.querySelector("#template_milestone")
const numbersOfStep = document.querySelectorAll("#number-of-step")
const formPlan = document.querySelector(".create_plan_form")
let counter = 1

function showNewFormMilestone() {
    counter++;

    const clone = template_milestone.content.cloneNode(true)
    clone.querySelector("#number-of-step").textContent = counter;
    stepsFormContainer.appendChild(clone)

    formPlan.setAttribute("action","addplan/"+counter);
}

addNewMilestoneButton.addEventListener("click", showNewFormMilestone)