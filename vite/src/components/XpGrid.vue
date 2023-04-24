<script setup>
import { ref, computed } from 'vue';
import XpGridCell from './XpGridCell.vue';
import XpForm from './XpForm.vue';

const props = defineProps({
    name: {
        type: String,
        default: 'contact'
    }
})

let form_name = ref('contact');
let nbr = ref(10);
let nbc = ref(10);

let total = computed(() => {
    return nbr.value * nbc.value;
});
</script>

<template>
    <div class="xp-grid">
        <h3>XpGrid ({{ total }})</h3>
        <div class="toolbar">
            <label>
                <span>{{ nbr }}</span>
                <input type="range" v-model.number="nbr" min="1" max="100" />
            </label>
            <label>
                <span>{{ nbc }}</span>
                <input type="range" v-model.number="nbc" min="1" max="100" />
            </label>
        </div>
        <table>
            <tbody>
                <tr v-for="r in nbr">
                    <td v-for="c in nbc" :title="(r-1) * nbr + c -1">
                        <XpGridCell :c="c-1" :r="r-1" :cmax="nbc" :rmax="nbr"/>
                    </td> 
                </tr>
            </tbody>
        </table>
        <div class="panel">
            <h3>Details</h3>
            <XpForm :name="form_name" />
        </div>
    </div>
</template>

<style>
/* .xp-grid is a grid layout */
.xp-grid {
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: auto 1fr;
    grid-template-areas:
        "header header header header"
        "toolbar toolbar toolbar toolbar"
        "body body panel panel"
    ;
    grid-gap: 1rem;
    padding: 1rem;
    border: 1px solid #ccc;
    border-radius: 0.5rem;
    margin: 1rem;
}
.xp-grid > h3 {
    grid-area: header;
}
.xp-grid > .toolbar {
    grid-area: toolbar;
}
.xp-grid > table {
    grid-area: body;
}
.xp-grid > .panel {
    grid-area: panel;
    min-width: 40vw
}

table {
    width: 100%;
    /* make cells same width */
    table-layout: fixed;
    text-align: center;
}
td {
    border: 1px solid #ccc;
    padding: 0.5rem 0 0.5rem 0;
    text-align: center;
}
td:hover {
    color: #000;
    background-color: #aaa;
}
</style>