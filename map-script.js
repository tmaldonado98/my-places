/*const key = '3UHgzHjbiaCYC7Bdr6V1';
const map = L.map('map').setView([49.2125578, 16.62662018], 14);
L.tileLayer(`https://api.maptiler.com/maps/streets-v2/{z}/{x}/{y}.png?key=${key}`,{
  tileSize: 512,
  zoomOffset: -1,
  minZoom: 1,
  attribution: "\u003ca href=\"https://www.maptiler.com/copyright/\" target=\"_blank\"\u003e\u0026copy; MapTiler\u003c/a\u003e \u003ca href=\"https://www.openstreetmap.org/copyright\" target=\"_blank\"\u003e\u0026copy; OpenStreetMap contributors\u003c/a\u003e",
  crossOrigin: true
}).addTo(map);*/

const key = '3UHgzHjbiaCYC7Bdr6V1';
const map = new maplibregl.Map({
    container: 'map',
    style: `https://api.maptiler.com/maps/streets-v2/style.json?key=${key}`,
    center: [11.86735, 10.54687],
    zoom: 1.25
});
const london = new maplibregl.Marker()
    .setLngLat([0.11, 51.49])
    .addTo(map);
map.on('error', function(err) {
    throw new Error("To load the map, you must replace YOUR_MAPTILER_API_KEY_HERE first, see README");
});