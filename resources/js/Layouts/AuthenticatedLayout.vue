<script setup>
import Nav from '@/Components/Nav.vue'
</script>

<template>
  <Nav />

  <main class="mt-4 px-4 pb-6 sm:mt-6 sm:px-6">
    <slot />
  </main>
</template>
