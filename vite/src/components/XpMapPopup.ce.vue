<script setup>
// properties name
// add prop name with default value ''
// add prop index with default value 0
const props = defineProps({
    name: {
        type: String,
        default: ''
    },
    index: {
        type: Number,
        default: 0
    }
})


let lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl nec ultricies lacinia, nunc nisl aliquam nisl, eget aliquam nisl nisl s'

</script>

<template>
    <div>
        <h3>XpMapPopup ({{ index }})</h3>
        <p>{{lorem}}</p>
        <input type="checkbox" value="Hello" />
        <button>Click me</button>
    </div>
</template>