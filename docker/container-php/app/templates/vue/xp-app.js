
import { map, tileLayer, marker, popup, circleMarker } from 'leaflet'
// WARNING: case sensitive as circleMarker is not the same as CircleMarker

let computed = {
    xpv() {
        return this.$xpv()
    }
}

let mymap = null;
let mymarker = null;
let mymarker2 = null;

let mounted = function () {
    let map_tag = this.$refs.map
    let focus = [48.8566, 2.3522]
    // change focus to random location
    focus = [-50 + Math.random() * 100, -50 + Math.random() * 100]

    mymap = map(map_tag).setView(focus, 5);

    // openstreetmap
    let map_url = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
    // local proxy
    map_url = '/map/{z}_{x}_{y}.png'

    const tiles = tileLayer(map_url, {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(mymap);

    mymarker2 =
        circleMarker(focus, {
            radius: 40,     // in pixels, independant of zoom level
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            // draggable: true, // KO not draggable
        })
            .addTo(mymap)
            .bindPopup('<h1>HELLO</h1>').openPopup();

    mymarker = marker(focus, {
        draggable: true,
    })
    mymarker
        .addTo(mymap)
        .bindPopup('<b>Hello world!</b><br />I am a popup.').openPopup();

    const mypopup = popup()
        .setLatLng(focus)
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

    // center on marker
    mymap.setView(focus, 10)
}

let methods = {
    act_teleport: function (event) {
        console.log('teleport', event)
        if (mymap) {
            // change mymarker2 to mymarker
            mymarker2.setLatLng(mymarker.getLatLng())

            // change to a random location
            let focus = [-70 + Math.random() * 140, -150 + Math.random() * 300]
            // change zoom
            this.zoom = Math.round(5 + Math.random() * 10)

            // update mymarker
            mymarker.setLatLng(focus)
            // fly to new location
            mymap.flyTo(focus, this.zoom)
        }
    }
}
let data = {
    zoom: 5,
}

export default {
    template: "#xp-app",
    computed,
    mounted,
    methods,
    // WARNING: copy data for each instance
    data: () => Object.assign({}, data),
}