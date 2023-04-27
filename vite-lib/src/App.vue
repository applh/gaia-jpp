<script setup>
import { MyTestA } from '../lib/mytest.js'

</script>

<template>
  <h1>{{ $mytest('hello') }} / {{ $mytest('test') }}</h1>
  <MyTestA />
</template>

<style scoped>
</style>
