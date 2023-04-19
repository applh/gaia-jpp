<script setup>
import { defineAsyncComponent, reactive, computed } from 'vue'

let data_store = await import('./data-store.js') 

const store = computed(() => data_store.default.store)

const XpBox1 = defineAsyncComponent(() => import('./XpBox1.vue'))
const XpBox2 = defineAsyncComponent(() => import('./XpBox2.vue'))
const XpBox3 = defineAsyncComponent(() => import('./XpBox3.vue'))
const XpBox4 = defineAsyncComponent(() => import('./XpBox4.vue'))

</script>

<template>
    <XpBox1 v-if="store.width < 800" />
    <XpBox2 v-else-if="store.width < 1200" />
    <XpBox3 v-else-if="store.width < 1600" />
    <XpBox4 v-else />
    <h3>{{ store.width }}x{{ store.height }}</h3>
</template>

<style>
label {
    display: inline-block;
    padding: 1rem;
}
label span {
    padding-left: 0.5rem;
}
</style>