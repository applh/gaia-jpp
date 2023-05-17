import XpGaia from "XpGaia"

let data = {
    form: null,
    size: 6,
    score2: 1,
    mode_edit: false,
    posts: [],
    ui_table: true,
    ui_grid: false,
    ui_dev: false,
    form_feedback: {}
}

let computed = {
}

let methods = {
    act_submit: async function(event) {
        console.log('submit', event)
    },
    act_save: async function(post) {
        console.log('save', post)
        let inputs = post 

        let json = await this.$xp('api/json', {
            form_name: 'crud_save_post', 
            inputs 
        })
        console.log('json', json)
        // get the feedback if present
        if ('crud_save_post' in json) {
            this.form_feedback = json['crud_save_post']
            // remove from the list and re-add ordered by z
            let index = this.posts.indexOf(post)
            if (index > -1) {
                this.posts.splice(index, 1)
            }
            // find the right position with z value descending
            let z = post.z
            let i = 0
            for (; i < this.posts.length; i++) {
                if (z > this.posts[i].z) {
                    break
                }
            }
            // insert at the right position
            this.posts.splice(i, 0, post)
        }
    },
    act_edit: async function(post) {
        console.log('edit', post)
        this.mode_edit = true
    },
    act_delete: async function(post) {
        console.log('delete', post)
        // remove from list
        let index = this.posts.indexOf(post)
        if (index > -1) {
            this.posts.splice(index, 1)
        }
    },
    media_src: function(p) {
        return '/media/zoom5/screenshot-zoom5-' + p.id + '.png'
    },
    media_class: function(p) {
        return {
            'box-img': true,
            'expand': p.expand
        }
    },
    txt: function (src, max=10, suffix='') {
        // cut to max chars
        if (src.length > max) {
            return src.substr(0, max) + suffix
        }

        return src
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