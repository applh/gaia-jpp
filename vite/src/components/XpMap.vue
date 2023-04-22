<script>
import { defineCustomElement } from 'vue'

// import leaflet css
import 'leaflet/dist/leaflet.css'

// https://vitejs.dev/guide/assets.html
import shadowUrl from 'leaflet/dist/images/marker-shadow.png'
import iconRetinaUrl from 'leaflet/dist/images/marker-icon-2x.png'
import iconUrl from 'leaflet/dist/images/marker-icon.png'

// import leaflet from 'leaflet'
import L from 'leaflet';

// let data_store = await import('./data-store.js')
import data_store from './data-store.js'
// console.log('data_store', data_store)

// define XpMapPopup as custom element
import XpMapPopup from './XpMapPopup.ce.vue'
const XpMapPopupElement = defineCustomElement(XpMapPopup);
customElements.define('xp-map-popup', XpMapPopupElement)



let lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl nec ultricies lacinia, nunc nisl aliquam nisl, eget aliquam nisl nisl s'

let cb_popup = function (e) {
    console.log('popup', e);
    let html = `
    <div>
        <h3>Popup ${e.xp_index}</h3>
        <xp-map-popup index="${e.xp_index}"/>
    </div>
    `
    return html;
}

let mounted = function () {
    const iconDefault = L.icon({
    iconRetinaUrl,
    iconUrl,
    shadowUrl,
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    tooltipAnchor: [16, -28],
    shadowSize: [41, 41]
    });

    L.Marker.prototype.options.icon = iconDefault;

    // set center
    let center = data_store.store?.map?.center ?? [51.505, -0.09];
    let zoom = data_store.store?.map?.zoom ?? 13;

    let tiles_url = data_store.store?.map?.tiles_url ?? 'https://tile.openstreetmap.org/{z}/{x}/{y}.png';
    const map = L.map(this.$refs.boxmap).setView(center, zoom);
    const tiles = L.tileLayer(tiles_url, {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // resize map on window resize
    window.addEventListener('resize', () => {
        map.invalidateSize();
    });

    // add marker around center
    let pos = center;
    // console.log('pos', pos)

    // move pos randomly around 1km radius
    pos.lat += (Math.random() - 0.5) * 0.05;
    pos.lng += (Math.random() - 0.5) * 0.05;
    const marker = L.marker(pos, {
        draggable: true,
    }).addTo(map);
    // add popup to marker
    marker.bindPopup('I am a popup.');
    

    // move pos randomly around 1km radius
    pos.lat += (Math.random() - 0.5) * 0.05;
    pos.lng += (Math.random() - 0.5) * 0.05;
    // console.log('pos', pos)
    const circle = L.circle(pos, {
		color: 'red',
		fillColor: '#f03',
		fillOpacity: 0.5,
		radius: 500
	}).addTo(map);

    let points = [];
    let ppos = pos;
    for (let i = 0; i < 10; i++) {
        // move pos randomly around 1km radius
        ppos.lat += (Math.random() - 0.5) * 0.1;
        ppos.lng += (Math.random() - 0.5) * 0.1;
        // console.log('ppos', ppos)

        points.push([ppos.lat, ppos.lng]);
    }
	const polygon = L.polygon(points).addTo(map);

    // insert 1000 random markers
    // WARNING: 10.000 is too much for UX performance
    for (let i = 0; i < 1000; i++) {
        // limit random lat and lng to [-80, 80] and [-170, 170]
        pos.lat = (Math.random() -0.5) * 160;
        pos.lng = (Math.random() -0.5) * 340;
        // console.log('pos', pos)

        const circle = L.marker(pos, {
            draggable: true,
        }).addTo(map);

        // add popup to circle
        // popups can stay open
        circle.xp_index = i;
        circle.bindPopup(cb_popup, {
            autoClose: false,
            closeOnClick: false,
            direction: 'center',
            className: 'my-label',
            offset: [0, 0]
        });
    }
}

let computed = {
    store: function () {
        return data_store.store;
    }
}

export default {
    name: 'XpMap',
    mounted,
    computed,
}
</script>

<template>
    <em v-if="store.map.title">{{ store.map.title }}</em>
    <div ref="boxmap" class="xpmap"></div>
</template>

<style>
.xpmap {
    width: 100%;
    height: 50vmin;
    margin: 0 auto;
}
</style>