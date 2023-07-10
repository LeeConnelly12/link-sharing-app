<script setup>
import SocialLink from '@/Components/SocialLink.vue'

defineProps({
  user: Object,
  links: Array,
})
</script>

<template>
  <svg width="308" height="632" fill="none" viewBox="0 0 308 632">
    <path
      stroke="#737373"
      d="M1 54.5C1 24.953 24.953 1 54.5 1h199C283.047 1 307 24.953 307 54.5v523c0 29.547-23.953 53.5-53.5 53.5h-199C24.953 631 1 607.047 1 577.5v-523Z"
    />
    <path
      fill="#fff"
      stroke="#737373"
      d="M12 55.5C12 30.923 31.923 11 56.5 11h24C86.851 11 92 16.149 92 22.5c0 8.008 6.492 14.5 14.5 14.5h95c8.008 0 14.5-6.492 14.5-14.5 0-6.351 5.149-11.5 11.5-11.5h24c24.577 0 44.5 19.923 44.5 44.5v521c0 24.577-19.923 44.5-44.5 44.5h-195C31.923 621 12 601.077 12 576.5v-521Z"
    />

    <!-- Profile picture -->
    <template v-if="user?.profile_picture">
      <defs>
        <pattern id="avatar" x="0" y="0" height="1" width="1">
          <image
            preserveAspectRatio="xMidYMid slice"
            x="0"
            y="0"
            height="100"
            width="100"
            :xlink:href="user.profile_picture"
          />
        </pattern>
      </defs>
      <circle
        cx="153.5"
        cy="112"
        r="48"
        stroke="#633CFF"
        stroke-width="4"
        fill="url(#avatar)"
      ></circle>
    </template>
    <circle v-else cx="153.5" cy="112" r="48" fill="#EEE" />

    <!-- Name -->
    <foreignObject
      v-if="user.first_name"
      x="0"
      y="180"
      width="100%"
      height="32"
      rx="4"
    >
      <p class="text-center font-bold">
        {{ user.first_name }} {{ user.last_name }}
      </p>
    </foreignObject>
    <rect v-else width="160" height="16" x="73.5" y="185" fill="#EEE" rx="8" />

    <!-- Email -->
    <foreignObject
      v-if="user.email"
      x="0"
      y="208"
      width="100%"
      height="32"
      rx="4"
    >
      <p class="text-center text-xs">
        {{ user.email }}
      </p>
    </foreignObject>
    <rect v-else width="72" height="8" x="117.5" y="214" fill="#EEE" rx="4" />

    <!-- Links -->
    <foreignObject
      v-for="(link, index) in links"
      :key="link.id"
      width="100%"
      height="44"
      x="0"
      :y="278 + index * 64"
      rx="4"
    >
      <SocialLink class="mx-auto h-[44px] w-[237px]" :link="link" />
    </foreignObject>
  </svg>
</template>
