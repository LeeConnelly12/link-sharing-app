<script setup>
import { getColorForPlatform } from '@/platforms.js'

defineProps({
  link: {
    type: Object,
    required: true,
  },
})
</script>

<template>
  <a
    :href="link.url"
    :style="`background-color: ${getColorForPlatform(link.platform)}`"
    class="flex items-center justify-between rounded-lg p-4"
    :class="
      { 'borders border': link.platform === 'Frontend Mentor' },
      link.platform === 'Frontend Mentor' ? 'text-dark-gray' : 'text-white'
    "
  >
    <p>{{ link.platform }}</p>
    <svg width="16" height="16" fill="none" viewBox="0 0 16 16">
      <path
        fill="currentColor"
        d="M2.667 7.333v1.334h8L7 12.333l.947.947L13.227 8l-5.28-5.28L7 3.667l3.667 3.666h-8Z"
      />
    </svg>
  </a>
</template>
