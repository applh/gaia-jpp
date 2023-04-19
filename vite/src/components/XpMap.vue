<script>
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

    const map = L.map(this.$refs.boxmap).setView(center, zoom);
    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
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
    const marker = L.marker(pos).addTo(map);

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
}

export default {
    name: 'XpMap',
    mounted
}
</script>

<template>
    <em>XpMap</em>
    <div ref="boxmap" class="xpmap"></div>
</template>

<style>
.xpmap {
    width: 50vmin;
    height: 50vmin;
    margin: 0 auto;
}
</style>