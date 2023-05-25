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
    form_feedback: {},
    filter: '',
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
    },
    filter_ok (p) {
        if (!this.filter) {
            p.filter_ok = true
            return true
        }
        // filter on created
        if (p.created.indexOf(this.filter) > -1) {
            p.filter_ok = true
            return true
        }

        p.filter_ok = false
        return false
    },
    filter_ok_count(filter) {
        // FIXME: DOM is not sync with data
        // select all h3.filter-ok
        // let count = document.querySelectorAll('.box-crud table h3.filter-ok').length
        let count = 0
        for (let p of this.posts) {
            if (p.filter_ok) {
                count++
            }
        }
        console.log('filter_ok_count', filter, count)
        return count
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