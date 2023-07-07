<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const user = computed(() => usePage().props.auth.user)

async function copyShareLinkToClipboard() {
  const url = route('previews.show', user.value)
  await navigator.clipboard.writeText(url)
}
</script>

<template>
  <nav v-if="user" class="grid grid-cols-2 gap-x-4 p-4">
    <Link
      href="/"
      class="inline-flex h-[46px] w-full items-center justify-center rounded-lg border border-purple bg-white px-4 font-semibold text-purple shadow-sm transition duration-150 ease-in-out hover:bg-light-purple focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25"
    >
      Back to Editor
    </Link>
    <PrimaryButton type="button" @click="copyShareLinkToClipboard">
      Share Link
    </PrimaryButton>
  </nav>

  <main class="mt-14 px-16 pb-10 text-center">
    <slot />
  </main>
</template>
