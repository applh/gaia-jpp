<script setup>
import { ref } from 'vue'
let size = ref(10)

</script>
<template>
    <span>size: {{ size }} / total: {{ size*size }}</span>
    <input class="w-full" type="range" min="1" max="100" v-model.number="size" />
    <div class="overflow-auto">
        <table class="v-full">
            <tbody>
                <tr v-for="r in size">
                    <td class="b-1 text-sm" v-for="c in size">{{ size * (r -1) + c }}</td>
                </tr>
            </tbody>
        </table>
    </div>

</template>