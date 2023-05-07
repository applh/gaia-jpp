console.log('xp-test.js loaded');

let computed = {
    xpv () {
        return this.$xpv()
    }
}

export default {
    template: `
    <div>
        <h1>XP Test</h1>
        <button @click.prevent="$xpv().counter++">{{ $xpv().counter }}</button>
    </div>
    `,
    computed,
}