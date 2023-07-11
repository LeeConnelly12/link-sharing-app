<script setup>
import Layout from '@/Layouts/PreviewLayout.vue'
import SocialLink from '@/Components/SocialLink.vue'
import { usePage, Head } from '@inertiajs/vue3'
import { computed } from 'vue'

const user = computed(() => usePage().props.auth.user)

defineProps({
  links: Array,
})
</script>

<template>
  <Layout>
    <Head title="Preview" />

    <img
      class="inline-block aspect-square rounded-full border-4 border-purple object-cover"
      :src="user.profile_picture"
      width="112"
      height="112"
      alt="Profile picture"
    />
    <h1 class="mt-6 text-[2rem] font-bold text-dark-gray">
      {{ user.first_name }} {{ user.last_name }}
    </h1>
    <p class="mt-2">{{ user.email }}</p>
    <div class="mt-14 grid gap-y-5">
      <SocialLink
        v-for="link in links"
        :key="link.id"
        :link="link"
        class="h-14"
      />
    </div>
  </Layout>
</template>
