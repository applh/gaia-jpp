<script setup>
import { ref, watch } from 'vue'
// let size = ref(10)
// define props
let props = defineProps({
    total: {
        type: Number,
        default: 10
    }
})

let size = ref(Math.round(Math.sqrt(props.total)))

// watch props
watch(() => props.total, (newVal) => {
    size.value = Math.round(Math.sqrt(newVal))
})

// size 
</script>
<template>
    <span>size: {{ size }} / total: {{ size * size }}</span>
    <input class="w-full" type="range" min="1" max="100" v-model.number="size" />
    <div class="overflow-auto">
        <table class="v-full">
            <tbody>
                <tr v-for="r in size">
                    <td class="b-1 text-sm" v-for="c in size">{{ size * (r -1) + c }}</td>
                </tr>
            </tbody>
        </table>
    </div>

</template>