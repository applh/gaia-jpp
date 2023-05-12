// WARNING: case sensitive as circleMarker is not the same as CircleMarker

let data = {
}

let methods = {

}

let computed = {
    xpv() {
        return this.$xpv()
    },
}

let mounted = async function () {
}


export default {
    template: "#xp-app",
    computed,
    mounted,
    methods,
    // WARNING: copy data for each instance
    data: () => Object.assign({}, data),
}