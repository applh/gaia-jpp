import XpGaia from "XpGaia"

let data = {
    form: null,
    size: 6,
    score2: 1,
    mode_edit: false,
    posts: [],
}

let computed = {

}
let methods = {
    act_submit: async function(event) {
        console.log('submit', event)
    },
    act_edit: async function(post) {
        console.log('edit', post)
        this.mode_edit = true
    },
    act_delete: async function(post) {
        console.log('delete', post)
    }

}

let props = {
    name: {
        default: '',
    },
    score: {
        default: 1,
    },
}

let created = async function() {
    // this.size = Math.ceil(Math.sqrt((this.score * this.score)))
    this.score2 = this.score
    this.posts = await this.$xp('posts')
}

export default {
    template: '#xp-crud',
    // WARNING: copy data for each instance 
    data: () => Object.assign({}, data),
    props,
    computed,
    created,
    methods,
}