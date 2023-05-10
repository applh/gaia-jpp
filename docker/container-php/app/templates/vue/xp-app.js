
import { map, tileLayer } from 'leaflet'

let computed = {
    xpv () {
        return this.$xpv()
    }
}

let mounted = function () {
    let map_tag = this.$refs.map
    let paris = [48.8566, 2.3522]
    const mymap = map(map_tag).setView(paris, 5);

    let map_url = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
    map_url = '/map/{z}_{x}_{y}.png'
    
	const tiles = tileLayer(map_url, {
		maxZoom: 19,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(mymap);
}

export default {
    template: "#xp-app",
    computed,
    mounted,
}