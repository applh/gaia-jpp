import XpGaia from 'XpGaia'

let template = '#xpc-marker'

// define props
let props = {
    name: {
        default: '',
    },
    index: {
        default: 0,
    },
}

let data = {
    marker: null,
    mStyle: {
        color: 'black',
        fillColor: '#f03',
        fillOpacity: 0.5,
    },
    activeStyle: {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        backgroundColor: '#ddd',
        padding: '1rem',
        zIndex: 999,
        borderRadius: '1rem',
    },
}

let methods = {
    get_style () {
        // if $xpv().map_marker_index == this.index
        // then return a different style
        // else return the default style
        if (XpGaia.vstore.map_marker_index == this.index) {
            return this.activeStyle;
        }

        return this.mStyle
    },
}

export default {
    template,
    props,
    methods,
    // copy data for each instance
    data: () => JSON.parse(JSON.stringify(data)),
}
