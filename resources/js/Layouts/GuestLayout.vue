<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <main class="bg-light-gray px-8 pt-8">
    <div>
      <Link href="/">
        <ApplicationLogo />
      </Link>
    </div>

    <div class="mt-16">
      <slot />
    </div>
  </main>
</template>
