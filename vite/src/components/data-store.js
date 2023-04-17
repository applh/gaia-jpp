import { reactive } from 'vue'

let store = reactive({
    counter: 0,
    width: window.innerWidth,
    height: window.innerHeight,
    forms: {
        'contact': {
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
        }
    },
})

// add event listener on window resize
window.addEventListener('resize', () => {
    store.width = window.innerWidth
    store.height = window.innerHeight
})

export let pjs = {
    app: null,
}

export default {
    store,
    pjs
}


