<template>
    <h1>Drauu</h1>
    <svg ref="boxdrauu" class="box-drauu"></svg>
</template>

<script>
import { createDrauu } from 'drauu'


export default {
    name: 'XpDraw',
    props: {
        name: {
            type: String,
            default: 'draw'
        }
    },
    mounted() {
        console.log('XpDraw mounted')
        let boxdrauu = this.$refs.boxdrauu
        console.log('boxdrauu', boxdrauu)
        const drauu = createDrauu({
            el: boxdrauu,
            brush: {
                mode: 'stylus', // 'line', 'reactangle', 'ellipse'
                color: 'skyblue',
                size: 5,
            }
        })

        // change brush color
        drauu.options.brush.color = 'red'
    }
}
</script>

<style scoped>
.box-drauu {
    width: 100%;
    aspect-ratio: 1 / 1 ;
    border: 1px solid #ccc;
}
</style>