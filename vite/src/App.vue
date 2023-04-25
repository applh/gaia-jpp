<script setup>
import { defineAsyncComponent } from 'vue'
// FIXME: full import ?
import 'element-plus/dist/index.css'

// async component
const XpBox = defineAsyncComponent(() => import('./components/XpBox.vue'))

</script>

<template>
  <Suspense>
    <XpBox />
  </Suspense>
</template>

<style scoped>
</style>
