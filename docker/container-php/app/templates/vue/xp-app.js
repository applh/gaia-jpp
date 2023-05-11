
import { map, tileLayer, marker, popup, circleMarker, divIcon } from 'leaflet'
// WARNING: case sensitive as circleMarker is not the same as CircleMarker

let computed = {
    xpv() {
        return this.$xpv()
    },
    async posts() {
        let posts = await this.$xp('posts')
        console.log('posts', posts)
        return posts
    }
}

let mymap = null;
let mymarker = null;
let mymarker2 = null;
let mymarker3 = null;
let divIcon1 = null;

// let markers = [];

function build_markers(markers, max=100) {
    // create 100 markers
    for (let i = 0; i < max; i++) {
        let rows = 2 + Math.floor(Math.random() * 4)
        let cols = 2 + Math.floor(Math.random() * 4)
        let iw = 160 * cols
        let ih = 40 * rows
        let di = divIcon({
            html: `<xpc-marker name="${i}" index="${i}" rows="${rows}" cols="${cols}"></xpc-marker>`,
            iconSize: [iw, ih],
            className: 'xpc-icon',
            riseOnHover: true,
        })
        let mpos = [-70 + Math.random() * 140, -150 + Math.random() * 300]
        let mm = marker(mpos, {
            draggable: true,
            icon: di,
        })
            .addTo(mymap);

        markers.push(mm)
    }
}

let mounted = async function () {
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

    // load posts
    let scraps = await this.$xp('posts')
    console.log('scraps', scraps)

    let markers = []
    build_markers(markers, scraps.length)
    // store markers
    this.$xpv0().markers = markers

    // create focusPane
    // https://leafletjs.com/reference.html#map-pane
    mymap.createPane('focusPane');
    mymap.getPane('focusPane').style.zIndex = 650;

    // center on marker
    mymap.setView(focus, 10)

    // teleport
    // this.act_teleport()

    // seledct a random marker
    this.$xpv().map_marker_index = Math.floor(Math.random() * markers.length)
    this.act_marker_focus()
}

let methods = {
    act_teleport (event) {
        // console.log('teleport', event)
        if (mymap) {
            // change mymarker2 to mymarker
            mymarker2.setLatLng(mymarker.getLatLng())

            // change to a random location
            let focus = [-70 + Math.random() * 140, -150 + Math.random() * 300]
            // change zoom
            // WARNING: limit zoom as small tiles are consuming lot of disk space
            this.zoom = Math.round(4 + Math.random() * 4)

            // update mymarker
            mymarker.setLatLng(focus)
            // fly to new location
            mymap.flyTo(focus, this.zoom)
        }
    },
    act_marker_focus () {
        if (mymap) {
            let markers = this.$xpv0().markers

            // get the position of the next marker
            let current = 1 * this.$xpv().map_marker_index;
            let next = (current + 0) % markers.length;
            let m = markers[next];
            // move marker to focusPane
            let fp = m.getPane('focusPane')
            fp.appendChild(m._icon)

            let next_pos = m.getLatLng();
            // fly to new location
            mymap.flyTo(next_pos, this.zoom)

        }
    },
    act_marker_next () {
        if (mymap) {
            let markers = this.$xpv0().markers

            // get the position of the next marker
            let current = 1 * this.$xpv().map_marker_index;
            // reset zindex
            let mcur = markers[current];
            mcur.setZIndexOffset(current)

            let next = (current + 1) % markers.length;
            let m = markers[next];
            let next_pos = m.getLatLng();

            // move marker to focusPane
            let fp = m.getPane('focusPane')
            fp.appendChild(m._icon)

            // fly to new location
            mymap.flyTo(next_pos, this.zoom)

            // update the marker index
            this.$xpv().map_marker_index = next;
        }
    },
    act_marker_prev () {
        if (mymap) {
            let markers = this.$xpv0().markers

            // get the position of the next marker
            let current = 1 * this.$xpv().map_marker_index;
            // reset zindex
            let mcur = markers[current];
            mcur.setZIndexOffset(current)

            let next = (current - 1 + markers.length) % markers.length;
            let m = markers[next];
            let next_pos = m.getLatLng();

            // move marker to focusPane
            let fp = m.getPane('focusPane')
            fp.appendChild(m._icon)

            // fly to new location
            mymap.flyTo(next_pos, this.zoom)

            // update the marker index
            this.$xpv().map_marker_index = next;
        }
    },
    markers_length() {
        let markers = this.$xpv0()?.markers ?? 0

        return markers.length
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