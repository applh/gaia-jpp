<template>
    <footer v-if="$slidev.nav.currentLayout !== 'cover'" class="absolute bottom-0 right-2 p-2 text-[8px]">
        {{ $slidev.nav.currentPage }} / {{ $slidev.nav.total }}
    </footer>
</template>