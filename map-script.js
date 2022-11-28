const key = '3UHgzHjbiaCYC7Bdr6V1';
const map = new maplibregl.Map({
    container: 'map',
    style: `https://api.maptiler.com/maps/35df50b2-be27-431c-890b-23ce12b847e1/style.json?key=3UHgzHjbiaCYC7Bdr6V1`,
    center: [11.86735, 10.54687],
    zoom: 1.35
});
map.addControl(new maplibregl.NavigationControl(), 'top-right');

// let lat;
// let long;
/*
const country = new maplibregl.Marker()
    .setLngLat([lat, long])
    .addTo(map);

    map.on('error', function(err) {
    throw new Error("To load the map, you must replace YOUR_MAPTILER_API_KEY_HERE first, see README");
});
*/