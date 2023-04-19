<script setup>
import { computed } from 'vue'

// add prop name with default value contact
const props = defineProps({
    name: {
        type: String,
        default: 'contact'
    }
})

let data_store = await import('./data-store.js')

let store = computed(() => data_store.default.store)
let form = computed(() => data_store.default.store.forms[props.name ?? 'contact'] ?? null)

function act_submit ($event) {
    console.log('act_submit', $event.target)
}

</script>

<template>
    <form v-if="form" @submit.prevent="act_submit">
        <em>XpForm</em>
        <label v-for="fin in form.inputs">
            <span>{{ fin.label }}</span>
            <textarea v-if="fin.type === 'textarea'" :name="fin.name" v-model="fin.value" cols="80" rows="10"/>
            <input v-else :type="fin.type" :name="fin.name" v-model="fin.value" />
        </label>
        <button type="submit">{{ form.labels.submit }}</button>
    </form>
</template>

<style scoped>
    form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        width: 100%;
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