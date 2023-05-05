<script setup>
import { ref } from 'vue'
let level = ref(0)
level = Math.round(Math.sqrt($slidev.nav.total))
</script>

<template>
    <div class="text-right" v-if="$slidev.configs?.xp?.level">
        <hr />
        <span v-for="l in level">⭐️</span>
        Level {{ level }}
    </div>
</template>