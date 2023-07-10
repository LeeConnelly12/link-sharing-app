<script setup>
defineProps({
  message: {
    type: String,
  },
})
</script>

<template>
  <div v-show="message">
    <p class="text-re pointer-events-none text-sm">
      {{ message }}
    </p>
  </div>
</template>
