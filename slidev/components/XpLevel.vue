<script setup>
import { ref } from 'vue'
let level = ref(0)
let level10 = ref(0)
let level0 = ref(0)

level = Math.ceil(Math.sqrt($slidev.nav.total))
level10 = Math.floor(0.1 * level)
level0 = 1 * level % 10
</script>

<template>
    <div class="text-right" v-if="$slidev.configs?.xp?.level">
        <hr />
        <span v-for="l in level10">⭐️ </span>
        <span>Level {{ level }}</span>
        <span v-for="l in level0"> 🔥</span>
    </div>
</template>