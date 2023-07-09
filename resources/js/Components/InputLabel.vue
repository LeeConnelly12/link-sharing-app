<script setup>
defineProps({
  value: {
    type: String,
  },
})
</script>

<template>
  <label class="block text-xs text-dark-gray">
    <span v-if="value">{{ value }}</span>
    <span v-else><slot /></span>
  </label>
</template>
