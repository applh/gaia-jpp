let data = {
    form: {
        name: 'contact',
        fields: [
            {
                name: 'name',
                type: 'text',
                label: 'Name',
                value: '',
                placeholder: 'Your name',
                required: true,
                minlength: 3,
                maxlength: 32,
            },
            {
                name: 'email',
                type: 'email',
                label: 'Email',
                value: '',
                placeholder: 'Your email',
                required: true,
                minlength: 3,
                maxlength: 255,
            },
            {
                name: 'message',
                type: 'textarea',
                label: 'Message',
                value: '',
                placeholder: 'Your message',
                required: true,
                minlength: 3,
                maxlength: 1024,
            },
        ],
    },
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

export default {
    template: '#xp-form',
    data: () => data,
    methods,

}