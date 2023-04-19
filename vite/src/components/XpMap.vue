<script>
// import leaflet css
import 'leaflet/dist/leaflet.css'
// import leaflet from 'leaflet'
import L from 'leaflet'

let mounted = function () {

    const map = L.map(this.$refs.boxmap).setView([51.505, -0.09], 13);

    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // resize map on window resize
    window.addEventListener('resize', () => {
        map.invalidateSize();
    });
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