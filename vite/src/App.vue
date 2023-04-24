<script setup>
import { defineAsyncComponent } from 'vue'

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
