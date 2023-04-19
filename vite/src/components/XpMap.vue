<script>
// import leaflet css
import 'leaflet/dist/leaflet.css'

import shadowUrl from 'leaflet/dist/images/marker-shadow.png'
import iconRetinaUrl from 'leaflet/dist/images/marker-icon-2x.png'
import iconUrl from 'leaflet/dist/images/marker-icon.png'

// import leaflet from 'leaflet'
import L from 'leaflet';

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

    const map = L.map(this.$refs.boxmap).setView([51.505, -0.09], 13);

    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // resize map on window resize
    window.addEventListener('resize', () => {
        map.invalidateSize();
    });

    const marker = L.marker([51.5, -0.09]).addTo(map);

    const circle = L.circle([51.508, -0.11], {
		color: 'red',
		fillColor: '#f03',
		fillOpacity: 0.5,
		radius: 500
	}).addTo(map);

	const polygon = L.polygon([
		[51.509, -0.08],
		[51.503, -0.06],
		[51.51, -0.047]
	]).addTo(map);
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
}
</style>