var mymap = L.map('mapid').setView([47.16156163590006, 27.584009170532227], 13);
L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    // attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'pk.eyJ1Ijoic2lyY3FxIiwiYSI6ImNqdmF1bWIyaTFnYWIzeXMxMDBnN21oaDMifQ.fzVeJxr-LkQUfAKR5Tmjhw'
}).addTo(mymap);

var marker = L.marker([47.16156163590006, 27.584009170532227]).addTo(mymap);