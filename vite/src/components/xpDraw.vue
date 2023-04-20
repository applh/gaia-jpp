<script setup>
import { ref } from 'vue'
import { toRefs } from '@vueuse/core'
import { useDrauu } from '@vueuse/integrations/useDrauu'

const colors = ref(['black', '#ef4444', '#22c55e', '#3b82f6'])

const target = ref()
const { undo, redo, canUndo, canRedo, brush } 
= useDrauu(target, {
})

const { color, size } = toRefs(brush)

</script>

<template>
    <div class="toolbar">
        <div
            v-for="_color in colors"
            :key="_color"
            :class="{ active: _color === color }"
            class="color-button"
            :style="{ background: _color }"
            @click.prevent="() => color = _color"
          >v</div>
          <input type="range" min="1" max="20" v-model="size" />
          <div class="color-button" :style="{ background: color }">{{ size }}</div>
          <div class="color-button" :style="{ background: color }" @click.prevent="undo">😅</div>
    </div>
    <svg ref="target"></svg>
</template>

<style scoped>
svg {
    width: 100%;
    aspect-ratio: 1 / 1;
    background: #eee;
}
.color-button {
    display: inline-block;
    aspect-ratio: 1 / 1;
    width: 1.5rem;
    padding: 0.5rem;
    border-radius: 50%;
    border: 1px solid #ccc;
    margin: 0.5rem;
    cursor: pointer;
}
</style>