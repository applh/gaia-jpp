import store from 'xp-store'


let template = `
<template v-if="target">
    <Teleport :to="target">
        <div class="xp-form">
            <form v-if="form" @submit.prevent="act_submit">
                <h1>{{ form?.title }}</h1>
                <label v-for="f in form.fields">
                    <span>{{ f.label }}</span>
                    <textarea v-if="f.type=='textarea'" :name="f.name" rows="10" v-model="f.value" required autocomplete="on"></textarea>
                    <input v-else :type="f.type" :name="f.name" :value="f.value" v-model="f.value" required autocomplete="on" />
                </label>
                <button type="submit">Send</button>
                <div class="feedback">{{ form?.feedback ?? '...' }}</div>
            </form>
        </div>
    </Teleport>
</template>
`

export default {
    template,
    props: {
        name: {
            type: String,
            default: 'contact',
        }
    },
    data: () => ({
        form: null,
        target: null,
    }),
    computed: {
        $vs: () => storer
    },
    methods: {
        async act_submit() {
            // console.log('submit', this.form)
            // else load it from server
            let url = `/api/forms`
            let json = await this.$xp_fetch(url, {
                class: 'form',
                method: 'submit',
                form: this.form,
            })
            // console.log('json', json)
            let form = json?.forms[this.form.name] ?? null
            if (form?.feedback) {
                this.form = form
            }
        }
    },
    async created() {
        this.form = await this.$form_load(this.name)
        // search for target
        let target  = document.querySelector(`[data-xp-form="${this.name}"]`)
        if (target) {
            this.target = target
            console.log('target', this.target)
        }
    },

}




