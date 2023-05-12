
import * as L from 'leaflet'

let template = '#xp-map'

let created = function () {

}

let mymap = null;
let mymarker = null;
let mymarker2 = null;
let mymarker3 = null;
let divIcon1 = null;

let mounted = async function () {
    let map_tag = this.$refs.map
    let focus = [48.8566, 2.3522]
    // change focus to random location
    focus = [-50 + Math.random() * 100, -50 + Math.random() * 100]

    mymap = L.map(map_tag, {
        zoomControl: false,
        attributionControl: false,
    })
        .setView(focus, 5)

    // openstreetmap
    let map_url = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
    // local proxy
    map_url = '/map/{z}_{x}_{y}.png'

    const tiles = L.tileLayer(map_url, {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    })
        .addTo(mymap)


    mymarker2 =
        L.circleMarker(focus, {
            radius: 40,     // in pixels, independant of zoom level
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            // draggable: true, // KO not draggable
        })
            .addTo(mymap)
            .bindPopup('<h1>HELLO</h1>')
            .openPopup()

    mymarker = L.marker(focus, {
        draggable: true,
    })
    mymarker
        .addTo(mymap)
        .bindPopup('<b>Hello world!</b><br />I am a popup.')
        .openPopup()

    const mypopup = L.popup()
        .setLatLng(focus)
        .setContent('I am a standalone popup.')
        .openOn(mymap)

    function onMapClick(e) {
        mymarker2.setLatLng(e.latlng)
        mypopup
            .setLatLng(e.latlng)
            .setContent(`You clicked the map at <br/>${e.latlng.toString()}`)
            .openOn(mymap)
    }

    mymap.on('click', onMapClick);

    // add controls
    L.Control.XpHud = L.Control.extend({
        onAdd: function (map) {
            let div = L.DomUtil.create('div', 'leaflet-control-xphud');
            div.innerHTML = `
                <div class="box-xpc-hud">
                    <div id="box-p5"></div>
                    <xpc-hud></xpc-hud>
                </div>
            `;
            return div;
        },
        onRemove: function (map) {
            // Nothing to do here
        }
    });

    L.control.xphud = function (opts) {
        return new L.Control.XpHud(opts);
    }
    // add control
    L.control.xphud({ position: 'bottomleft' }).addTo(mymap);

    L.control.scale({ position: 'bottomright' }).addTo(mymap);
    L.control.zoom({ position: 'bottomright' }).addTo(mymap);

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

    // store the XpMap instance
    this.$xpv0().map_xpc = this
}

function build_markers(markers, max = 100) {
    // create 100 markers
    for (let i = 0; i < max; i++) {
        let rows = 2 + Math.floor(Math.random() * 4)
        let cols = 2 + Math.floor(Math.random() * 4)
        let iw = 16 // 160 * cols
        let ih = 16 // 40 * rows
        let di = L.divIcon({
            html: `<xpc-marker style="position:absolute;top:0;left:0;" name="${i}" index="${i}" rows="${rows}" cols="${cols}"></xpc-marker>`,
            iconSize: [iw, ih],
            className: 'xpc-icon',
            riseOnHover: true,
        })
        let mpos = [-70 + Math.random() * 140, -150 + Math.random() * 300]
        let mm = L.marker(mpos, {
            draggable: true,
            icon: di,
        })
        .addTo(mymap);

        markers.push(mm)
    }
}


let methods = {
    act_teleport(event) {
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
    act_marker_focus($event) {
        if (mymap) {
            let markers = this.$xpv0().markers

            // get the position of the next marker
            let current = 1 * this.$xpv().map_marker_index;
            let next = (current + markers.length) % markers.length;

            let m = markers[next];
            // move marker to focusPane
            let fp = m.getPane('focusPane')
            fp.appendChild(m._icon)

            let next_pos = m.getLatLng();
            // fly to new location
            mymap.flyTo(next_pos, this.zoom)

            // update input value
            this.$xpv().map_marker_index = next;
        }
    },
    marker_focus (index) {
        if (mymap) {
            let markers = this.$xpv0().markers

            // get the position of the next marker
            let current = index;
            let next = (current + markers.length) % markers.length;

            let m = markers[next];
            // move marker to focusPane
            let fp = m.getPane('focusPane')
            fp.appendChild(m._icon)

            let next_pos = m.getLatLng();
            // fly to new location
            mymap.flyTo(next_pos, this.zoom)

            // update input value
            this.$xpv().map_marker_index = next;
        }
    },
    act_marker_next() {
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
    act_marker_prev() {
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

export default {
    template,
    // WARNING: copy data for each instance
    data: () => Object.assign({}, data),
    computed,
    methods,
    created,
    mounted,
}