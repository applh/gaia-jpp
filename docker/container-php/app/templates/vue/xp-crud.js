let data = {
    form: null,
    size: 6,
    score2: 1,
    mode_edit: false,
}

let methods = {
    act_submit: async function(event) {
        console.log('submit', event)
    },
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
}

export default {
    template: '#xp-crud',
    // WARNING: copy data for each instance 
    data: () => Object.assign({}, data),
    props,
    created,
    methods,
}