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

map.addControl(new maplibregl.NavigationControl(), 'top-right');