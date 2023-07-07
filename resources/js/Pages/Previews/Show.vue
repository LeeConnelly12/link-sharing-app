<script setup>
import PreviewLayout from '@/Layouts/PreviewLayout.vue'
import SocialLink from '@/Components/SocialLink.vue'

defineProps({
  user: Object,
})
</script>

<template>
  <PreviewLayout>
    <img
      class="inline-block h-28 w-28 rounded-full border-4 border-purple object-cover"
      :src="user.profile_picture"
      alt=""
    />
    <h1 class="mt-6 text-[2rem] font-bold text-dark-gray">
      {{ user.first_name }} {{ user.last_name }}
    </h1>
    <p class="mt-2">{{ user.email }}</p>
    <div class="mt-14 grid gap-y-5">
      <SocialLink v-for="link in user.links" :key="link.id" :link="link" />
    </div>
  </PreviewLayout>
</template>
