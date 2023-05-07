let template = `
<div>
    <h1>XP App</h1>
    <p>{{ xpv.message }}</p>
    <p>{{ $xp('reverse', 'coucou') }}</p>
    <button @click.prevent="xpv.counter++">{{ xpv.counter }}</button>
    <div v-if="xpv.counter % 2 == 1">
        <p>GOGO</p>
        <xp-test></xp-test>
        <xp-test-async></xp-test-async>
    </div>
    <xp-test-0></xp-test-0>
    <xp-test0></xp-test0>
    <xp-test></xp-test>
    <xp-test />
    <!-- NOT WORKING ?! 
            <xp-test-0 /> 
        -->
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