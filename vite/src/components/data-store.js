import { reactive } from 'vue'

let store = reactive({
    h1: 'GAIA',
    msg: 'Hello World',
    counter: 0,
    width: window.innerWidth,
    height: window.innerHeight,
    map : {
        title: 'Map',
        center: { // paris location
            lat: 48.8566,
            lng: 2.3522,
        },
        zoom: 12,
        tiles_url: 'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
    },
    options: {
        map: false
    },
    forms: {
        'newsletter': {
            tags: {
                title: 'h4',
            },
            'labels': {
                'title' : 'Subscribe to our newsletter',
                'submit' : 'Subscribe',
                'feedback': '...'
            },
            inputs: {
                'name': {
                    'label': 'Name',
                    'type': 'text',
                    'value': '',
                    'required': true,
                    'min': 3,
                    'max': 20,
                    'pattern': '^[a-zA-Z0-9]+$',
                    'error': 'Name must be between 3 and 20 characters and contain only letters and numbers'
                },
                'email': {
                    'label': 'Email',
                    'type': 'email',
                    'value': '',
                    'required': true,
                    'min': 3,
                    'max': 20,
                    'pattern': '^[a-zA-Z0-9]+$',
                    'error': 'Email must be between 3 and 20 characters and contain only letters and numbers'
                },
            },
        },
        'contact': {
            tags: {
                title: 'h4',
            },
            'labels': {
                'title': 'Contact us',
                'submit' : 'Send',
                'feedback': '...please fill our contact form...'
            },
            inputs: {
                'name': {
                    'label': 'Name',
                    'type': 'text',
                    'value': '',
                    'required': true,
                    'min': 3,
                    'max': 20,
                    'pattern': '^[a-zA-Z0-9]+$',
                    'error': 'Name must be between 3 and 20 characters and contain only letters and numbers'
                },
                'email': {
                    'label': 'Email',
                    'type': 'email',
                    'value': '',
                    'required': true,
                    'min': 3,
                    'max': 20,
                    'pattern': '^[a-zA-Z0-9]+$',
                    'error': 'Email must be between 3 and 20 characters and contain only letters and numbers'
                },
                'message': {
                    'label': 'Message',
                    'type': 'textarea',
                    'value': '',
                    'required': true,
                    'min': 3,
                    'max': 20,
                    'pattern': '^[a-zA-Z0-9]+$',
                    'error': 'Message must be between 3 and 20 characters and contain only letters and numbers'
                },
            },
        }
    },
})

// add event listener on window resize
window.addEventListener('resize', () => {
    store.width = window.innerWidth
    store.height = window.innerHeight
})

// HACK: custom window.xp_config
if (window.xp_config) {
    store.map.tiles_url = window.xp_config.map_tiles_url ?? store.map.tiles_url
}

export let pjs = {
    app: null,
}

export default {
    store,
    pjs
}


