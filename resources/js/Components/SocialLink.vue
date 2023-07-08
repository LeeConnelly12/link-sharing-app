<script setup>
defineProps({
  link: {
    type: Object,
    required: true,
  },
})

function getColorForPlatform(platform) {
  const colors = {
    'Github': '#1A1A1A',
    'Frontend Mentor': '#FFF',
    'Twitter': '#43B7E9',
    'LinkedIn': '#2D68FF',
    'Youtube': '#EE3939',
    'Facebook': '#2442AC',
    'Twitch': '#9146ff',
    'Dev.to': '#333',
    'Codewars': '#8A1A50',
    'freeCodeCamp': '#302267',
    'GitLab': '#EB4925',
    'Hashnode': '#0330D1',
    'Stack Overflow': '#EC7100',
  }

  return colors[platform]
}
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
