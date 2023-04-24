<script setup>
// props
const props = defineProps({
    name: {
        type: String,
        default: 'contact'
    },
    c: {
        type: Number,
        default: 0
    },
    r: {
        type: Number,
        default: 0
    },
    cmax: {
        type: Number,
        default: 0
    },
    rmax: {
        type: Number,
        default: 0
    }
})
    
</script>
<template>
    <div>{{ 1 + c + r * cmax }}</div>
</template>