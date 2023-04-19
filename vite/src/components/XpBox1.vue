<script setup>
import { defineAsyncComponent } from 'vue'

const MyTest = defineAsyncComponent(() => {
  return import('./MyTest')
})

</script>

<template>
    <MyTest />
</template>