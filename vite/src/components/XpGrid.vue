<script setup>
import { ref, computed } from 'vue';
import XpGridCell from './XpGridCell.vue';
import XpForm from './XpForm.vue';
import XpMap from './XpMap.vue';
import { ElButton, ElTree, ElTreeV2 } from 'element-plus';
// FIXME: draggable is working with el-tree but not el-tree-v2
// import css for eltree
import 'element-plus/es/components/tree/style/css'
import 'element-plus/es/components/button/style/css'


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

const tree_props = {
    value: 'id',
    label: 'label',
    children: 'children',
}
const tree_data = [
    {
        id: 1,
        label: 'Node 1',
        children: [
            {
                id: 11,
                label: 'Node 11',
                children: [
                    {
                        id: 111,
                        label: 'Node 111',
                    },
                ],
            },
        ],
    },
    {
        id: 2,
        label: 'Node 2',
        children: [
            {
                id: 21,
                label: 'Node 21',
                children: [
                    {
                        id: 211,
                        label: 'Node 211',
                    },
                ],
            },
        ],
    },
    {
        id: 3,
        label: 'Node 3',
        children: [
            {
                id: 31,
                label: 'Node 31',
                children: [
                    {
                        id: 311,
                        label: 'Node 311',
                    },
                ],
            },
        ],
    },
    {
        id: 4,
        label: 'Node 4',
        children: [
            {
                id: 41,
                label: 'Node 41',
                children: [
                    {
                        id: 411,
                        label: 'Node 411',
                    },
                ],
            },
        ],
    },
    {
        id: 5,
        label: 'Node 5',
        children: [
            {
                id: 51,
                label: 'Node 51',
                children: [
                    {
                        id: 511,
                        label: 'Node 511',
                    },
                ],
            },
        ],
    },
    {
        id: 6,
        label: 'Node 6',
        children: [
            {
                id: 61,
                label: 'Node 61',
                children: [
                    {
                        id: 611,
                        label: 'Node 611',
                    },
                ],
            },
        ],
    },
    {
        id: 7,
        label: 'Node 7',
        children: [
            {
                id: 71,
                label: 'Node 71',
                children: [
                    {
                        id: 711,
                        label: 'Node 711',
                    },
                ],
            },
        ],
    },
    {
        id: 8,
        label: 'Node 8',
        children: [
            {
                id: 81,
                label: 'Node 81',
                children: [
                    {
                        id: 811,
                        label: 'Node 811',
                    },
                ],
            },
        ],
    },
];

</script>

<template>
    <div class="xp-grid">
        <h3>XpGrid ({{ total }})</h3>
        <div class="plus">
            <el-button type="success">hello</el-button>
            <el-tree draggable droppable :data="tree_data" :props="tree_props" :height="208" />
        </div>
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
                    <td v-for="c in nbc" :title="(r - 1) * nbr + c - 1">
                        <XpGridCell :c="c - 1" :r="r - 1" :cmax="nbc" :rmax="nbr" />
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="panel">
            <h3>Details</h3>
            <XpForm :name="form_name" />
        </div>
        <div class="map">
            <XpMap />
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
        "toolbar toolbar . ."
        "body body panel panel"
        "body body panel panel"
        "body body plus plus"
        "body body map map"
    ;
    grid-gap: 1rem;
    padding: 1rem;
    border: 1px solid #ccc;
    border-radius: 0.5rem;
    margin: 1rem;
}

.xp-grid>h3 {
    grid-area: header;
}

.xp-grid>.toolbar {
    grid-area: toolbar;
}

.xp-grid>table {
    grid-area: body;
}

.xp-grid>.panel {
    grid-area: panel;
    min-width: 40vw
}

.xp-grid>.plus {
    grid-area: plus;
}
.xp-grid>.map {
    grid-area: map;
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
}</style>