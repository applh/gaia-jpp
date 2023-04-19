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
.logo {
  height: 6em;
  padding: 1.5em;
  will-change: filter;
  transition: filter 300ms;
}
.logo:hover {
  filter: drop-shadow(0 0 2em #646cffaa);
}
.logo.vue:hover {
  filter: drop-shadow(0 0 2em #42b883aa);
}
</style>
