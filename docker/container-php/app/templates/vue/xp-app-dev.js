let template = `
<div class="box_admin">
    <h2>DEV</h2>
    <p>{{ xpv.ww }}x{{ xpv.wh }}</p>
    <form>
        <label>
            <span>user id</span>
            <input type="text" v-model="xpv.user.id" />
        </label>
        <label>
            <span>user api key</span>
            <input type="text" v-model="xpv.user_api_key" />
        </label>
        <label>
            <span>admin api key</span>
            <input type="text" v-model="xpv.admin_api_key" />
        </label>
    </form>
</div>
`

let computed = {
    xpv () {
        return this.$xpv()
    }
}

export default {
    template,
    computed,
}

