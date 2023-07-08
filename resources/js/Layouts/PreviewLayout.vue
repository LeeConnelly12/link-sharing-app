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
  <div
    class="absolute left-0 right-0 top-0 hidden h-[357px] rounded-bl-[2rem] rounded-br-[2rem] bg-purple sm:block"
  ></div>
  <nav class="sm:px-6 sm:pt-6" v-if="user">
    <div
      class="relative flex justify-between gap-x-4 p-4 sm:rounded-xl sm:bg-white"
    >
      <Link
        href="/"
        class="inline-flex h-[46px] w-full items-center justify-center rounded-lg border border-purple bg-white px-7 font-semibold text-purple shadow-sm transition duration-150 ease-in-out hover:bg-light-purple focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 sm:w-max"
      >
        Back to Editor
      </Link>
      <PrimaryButton
        class="sm:w-max"
        type="button"
        @click="copyShareLinkToClipboard"
      >
        Share Link
      </PrimaryButton>
    </div>
  </nav>

  <main
    class="relative mx-auto mt-14 rounded-xl px-16 pb-10 text-center sm:mt-32 sm:w-[349px] sm:bg-white sm:py-12 sm:shadow-lg"
  >
    <slot />
  </main>
</template>
