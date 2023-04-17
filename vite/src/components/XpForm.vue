<script setup>
import { computed } from 'vue'

let data_store = await import('./data-store.js')

let store = computed(() => data_store.default.store)
let forms = computed(() => data_store.default.store.forms.contact ?? {})

function act_submit ($event) {
    console.log('act_submit', $event.target)
}

</script>

<template>
    <h3>XpForm</h3>
    <form @submit.prevent="act_submit">
        <label v-for="inout in forms">
            <span>{{ inout.label }}</span>
            <textarea v-if="inout.type === 'textarea'" :name="inout.name" v-model="inout.value" cols="80" rows="10"/>
            <input v-else :type="inout.type" :name="inout.name" v-model="inout.value" />
        </label>
        <button type="submit">Submit</button>
    </form>
</template>

<style scoped>
    form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        width: 100%;
        min-width: 400px;
        max-width: 800px;
    }
    label {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    input, textarea {
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 0.25rem;
    }
</style>