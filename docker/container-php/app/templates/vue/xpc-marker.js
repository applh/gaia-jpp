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
    rows: {
        type: Number,
        default: 3,
    },
    cols: {
        type: Number,
        default: 3,
    },
}

let data = {
    marker: null,
    mStyle: {
        textAlign:'left',
        color: 'black',
        fillColor: '#f03',
        fillOpacity: 0.5,
    },
    activeStyle: {
        textAlign:'left',
        color: '#fff',
        fillColor: '#f03',
        fillOpacity: 0.5,
        backgroundColor: 'rgba(0, 0, 0, 0.8)',
        padding: '1rem',
        zIndex: 700,
        borderRadius: '1rem',
    },
    contents: [],
}

let methods = {
    get_style () {
        // if XpGaia.vstore.map_marker_index == this.index
        // then return a different style
        // else return the default style
        if (XpGaia.vstore.map_marker_index == this.index) {
            return this.activeStyle;
        }

        return this.mStyle
    },
    act_marker () {
        XpGaia.vstore.map_marker_index = this.index
        let marker = XpGaia.store0.markers[this.index]
        if (marker) {
            // marker.setZIndexOffset(1000)
        }
        console.log('act_marker', this.index)
    },
    get_content(r, c) {
        let content = this.contents[r*this.cols + c]
        if (content) {
            return content
        }

        let img = '/template/img/photo.jpg'
        let txt = `${r}x${c}`
        // create random words 
        let words = []
        let n = 1 + Math.floor(Math.random() * 10)
        for (let i = 0; i < n; i++) {
            let w = Math.random().toString(36).substring(2, 15)
            words.push(w)
        }
        txt = words.join(' ')

        // select random txt or img
        if (Math.random() > 0.99) {
            content = `<img src="${img}" width="100%" />`
        }
        else {
            content = txt
        }
        // save content
        this.contents[r*this.cols + c] = content
        return content
    },
}

export default {
    template,
    props,
    methods,
    // copy data for each instance
    data: () => JSON.parse(JSON.stringify(data)),
}
