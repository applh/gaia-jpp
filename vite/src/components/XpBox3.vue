<script setup>
import { defineAsyncComponent } from 'vue'

const MyTest = defineAsyncComponent(() => {
  return import('./MyTest')
})

</script>

<template>
    <h1>XpBox3</h1>
    <MyTest />
</template>