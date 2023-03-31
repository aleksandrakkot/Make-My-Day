const top10WorldResults = document.querySelector(".top10-world-results")
const top10CountryResults = document.querySelector(".top10-country-results")
const topWorldButton = document.querySelector("#top10-in-world")
const topCountryButton = document.querySelector("#top10-in-country")

function setActiveOrNoActive(e,result){
    let nextButton
    let nextResult

    e.target === topWorldButton ? nextButton = topCountryButton : nextButton = topWorldButton
    result ===top10WorldResults ? nextResult = top10CountryResults : nextResult = top10WorldResults

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

topWorldButton.addEventListener("click" , (e) => {
    setActiveOrNoActive(e,top10WorldResults);
});
topCountryButton.addEventListener("click",(e) => {
    setActiveOrNoActive(e,top10CountryResults);
});