
import { map, tileLayer, marker, popup, circleMarker } from 'leaflet'
// WARNING: case sensitive as circleMarker is not the same as CircleMarker

let computed = {
    xpv () {
        return this.$xpv()
    }
}

let mounted = function () {
    let map_tag = this.$refs.map
    let paris = [48.8566, 2.3522]
    const mymap = map(map_tag).setView(paris, 5);

    // openstreetmap
    let map_url = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
    // local proxy
    map_url = '/map/{z}_{x}_{y}.png'

	const tiles = tileLayer(map_url, {
		maxZoom: 19,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(mymap);

    const mymarker2 = 
    circleMarker(paris, {
        radius: 40,     // in pixels, independant of zoom level
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        // draggable: true, // KO not draggable
        })
        .addTo(mymap)
        .bindPopup('<h1>HELLO</h1>').openPopup();
    const mymarker = marker(paris, {
                            draggable: true,
                        })
    mymarker
        .addTo(mymap)
		.bindPopup('<b>Hello world!</b><br />I am a popup.').openPopup();

    const mypopup = popup()
		.setLatLng(paris)
		.setContent('I am a standalone popup.')
		.openOn(mymap);

    function onMapClick(e) {
        mymarker2.setLatLng(e.latlng)
		mypopup
			.setLatLng(e.latlng)
			.setContent(`You clicked the map at <br/>${e.latlng.toString()}`)
			.openOn(mymap);
	}

	mymap.on('click', onMapClick);
}

export default {
    template: "#xp-app",
    computed,
    mounted,
}