let next = document.querySelector(".next");
let prev = document.querySelector(".prev");

next.addEventListener("click", function() {
    let items = document.querySelectorAll(".item");
    document.querySelector(".slide").appendChild(items[0]);
});

prev.addEventListener("click", function() {
    let items = document.querySelectorAll(".item");
    document.querySelector(".slide").prepend(items[items.length - 1]); // here the length of items = 6
});

var cities = [{
        name: "Hamburg",
        location: [53.547425386544006, 9.987030559633626],
    },
    {
        name: "Frankfurt",
        location: [50.110924, 8.682127],
    },
    {
        name: "Wiesbaden",
        location: [50.078218, 8.239761],
    },
];

var map = L.map("map2").setView([51.1657, 10.4515], 6);

L.tileLayer("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: "© OpenStreetMap contributors",
}).addTo(map);

var markers = {};

cities.forEach((city) => {
    var marker = L.marker(city.location).addTo(map);
    marker.bindPopup(`<b>${city.name}</b>`).openPopup();

    marker.on("mouseover", function() {
        marker.openPopup();
    });

    marker.on("mouseout", function() {
        marker.closePopup();
    });

    marker.on("click", function() {
        // Hier können Sie die Verlinkung implementieren, z.B. window.location.href = 'Link zur Stadtseite';
        alert(`Sie haben ${city.name} ausgewählt!`);
    });

    markers[city.name] = marker;
});

function highlightCity(city) {
    markers[city].openPopup();
    markers[city].setStyle({ fillColor: "yellow", color: "yellow" });
}