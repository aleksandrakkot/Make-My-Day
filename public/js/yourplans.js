const allYourPlansResult = document.querySelector(".all-your-plans-result")
const publicPlansResult = document.querySelector(".public-plans-result")
const privatePlansResult = document.querySelector(".private-plans-result")
const allYourPlansButton = document.querySelector("#all-your-plans")
const publicPlansButton = document.querySelector("#public-plans")
const privatePlansButton = document.querySelector("#private-plans")

function setActiveOrNoActive(e,result){
    let nextButton
    let nextResult

    e.target === allYourPlansButton ? nextButton = publicPlansButton : nextButton = allYourPlansButton
    result === allYourPlansResult ? nextResult = publicPlansResult : nextResult = allYourPlansResult

    console.log("actual: " + result.className)
    console.log("next: " + nextResult.className)

    if (!e.target.classList.contains("active") && !result.classList.contains("active")) {
        e.target.classList.add("active")
        result.classList.add("active")
    }

    if (nextButton.classList.contains("active") && nextResult.classList.contains("active")) {
        nextButton.classList.remove("active")
        nextResult.classList.remove("active")
    }
}

allYourPlansButton.addEventListener("click" , (e) => {
    setActiveOrNoActive(e,allYourPlansResult);
});

publicPlansButton.addEventListener("click",(e) => {
    setActiveOrNoActive(e,publicPlansResult);
});
