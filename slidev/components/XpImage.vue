<script setup>
// define Props
import { ref } from 'vue'
const props = defineProps({
    keywords: {
        default: 'nature'
    },
})

// will be mounted to the img tag
let img = ref(null)

// split keywords into array
let choices = props.keywords.split(',')
// pick a random keyword
let keyword = choices[Math.floor(Math.random() * choices.length)]
// trim the keyword
keyword = keyword.trim()
// generate a random number
let rando = Math.floor(Math.random() * 10000)
let src = `https://source.unsplash.com/random/600x800?${keyword}=${rando}`

</script>

<template>
    <div>
        <img ref="img" class="w-full" :src="src" alt="random image" />
    </div>
</template>