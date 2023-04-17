<script setup>
import { defineAsyncComponent } from 'vue'

const MyTest = defineAsyncComponent(() => {
  return import('./MyTest')
})

</script>

<template>
    <h1>XpBox1</h1>
    <MyTest />
</template>