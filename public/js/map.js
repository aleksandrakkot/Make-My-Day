mapboxgl.accessToken = 'pk.eyJ1IjoiZXdlbGluYTE3OSIsImEiOiJja3oxZG52cXkwd3huMnZvMTdvYnA0eDA4In0.6gmnsHuRGUz1QKuj9waY4A';
const cont = String(document.getElementById('map').innerText);

let map = null;

if(cont !== 'available'){
    document.querySelector('.map').style.display = 'none';
}else{
    const planId = window.location.href.split('/').at(-1);

    const data = {
        id: planId
    };

    fetch("/places", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response){
        return response.json();
    }).then(function (places) {
        places.map(place=>{
            place.coordinates = JSON.parse(place.coordinates);
        });
        setMap(places);
        displayPlaces(places);
    });
}


function displayPlaces(places){
    for (const feature of places) {
        const el = document.createElement('div');
        el.className = 'marker';


        let mark = new mapboxgl.Marker(el)
            .setLngLat(feature.coordinates)
            .setPopup(
                new mapboxgl.Popup({ offset: 25 }) // add popups
                    .setHTML(
                        `<h3>${feature.location_name}</h3><p>${feature.street_name} ${feature.street_number} </p>`
                    )
            )
            mark.addTo(map);

        console.log(mark);
    }
}

function setMap(places){
    if(places.length > 0) {
        const coord = places[0].coordinates;
        map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/light-v10',
            center: coord,
            zoom: 12
        });
    }
}