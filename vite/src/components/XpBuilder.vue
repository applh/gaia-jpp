<script setup>
import { ref } from 'vue'
import { useDraggable } from '@vueuse/core'
import draggable from 'vuedraggable'

const props = defineProps({
    name: {
        type: String,
        default: 'contact'
    }
})

const elmove = ref(null)

const { x, y, style } = useDraggable(elmove, {
    initialValue: { x: 200, y: 200 },
    // onStart: ({x, y}) => {
    //     // set elmove to absolute position
    //     // console.log('start', x, y)
    // },
    // onMove: ({ x, y }) => {
    //     console.log(style, x, y)
    // },
})

let mylist = ref([
    {
        id: 1,
        name: 'test1'
    },
    {
        id: 2,
        name: 'test2'
    },
    {
        id: 3,
        name: 'test3'
    },
    {
        id: 4,
        name: 'test4'
    }
])

let drag = false

</script>

<template>
    <div ref="elmove" :style="style" style="position:fixed;z-index:9999">
        <p>Drag me! I am at {{x}}, {{y}}</p>
    </div>
    <hr />
    <ol>
        <li v-for="li in mylist">
            <div>{{ li.name }}</div>
        </li>
    </ol>
    <hr />
    <div>drag elements in the list ({{  mylist.length }})</div>
    <draggable v-model="mylist" item-key="id" @start="drag=true" @end="drag=false">
        <template #item="{element}">
            <div>{{element.name}}</div>
        </template>
    </draggable>
</template>