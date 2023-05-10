let data = {
    form: null,
}

let methods = {
    act_submit: async function(event) {
        console.log('submit', event)
        let inputs = {}
        // fill with form fields
        this.form.fields.forEach(field => {
            inputs[field.name] = field.value
        })
        let json = await this.$xp('api/json', {
            form_name: this.form.name, 
            inputs 
        })
        console.log('json', json)
    },
}

let props = {
    name: {
        default: '',
    },
}

let created = async function() {
    console.log('created', this.name)
    // copy form to local data
    this.form = JSON.parse(JSON.stringify(this.$xpv().forms[this.name]))

    // this.form = Object.assign({}, this.$xpv().forms[this.name])
    console.log('form', this.form)
}

export default {
    template: '#xp-form',
    // WARNING: copy data for each instance 
    data: () => Object.assign({}, data),
    props,
    created,
    methods,
}