<script setup>
import Nav from '@/Components/Nav.vue'
import { usePage } from '@inertiajs/vue3'
import { watch } from 'vue'
import { computed } from 'vue'
import { Toaster, toast } from 'vue-sonner'

const message = computed(() => usePage().props.flash.message)

watch(
  message,
  () => {
    if (!message.value) {
      return
    }

    toast.success(message)
  },
  { deep: true },
)
</script>

<template>
  <Nav />

  <main class="mt-4 px-4 pb-4 sm:mt-6 sm:px-6">
    <slot />
  </main>

  <Toaster :expand="true" position="bottom-center" />
</template>
