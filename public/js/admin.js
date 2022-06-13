const moderateIcon = document.querySelector("#moderate-icon")
const baseContainer = document.querySelector(".base-container")

function ifAdmin() {
    const adm = parseInt(baseContainer.getAttribute("id"));

    if (adm === 1) {
        console.log('Jestes adminem!')
        console.log(moderateIcon)
        moderateIcon.style.display = "flex";
    } else if(adm === 0) {
        moderateIcon.style.display = "none";
    }
}

ifAdmin();