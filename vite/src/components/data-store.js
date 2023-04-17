import { reactive } from 'vue'

let store = reactive({
    counter: 0,
    width: window.innerWidth,
    height: window.innerHeight,
})

// add event listener on window resize
window.addEventListener('resize', () => {
    store.width = window.innerWidth
    store.height = window.innerHeight
})

export default {
    store
}


