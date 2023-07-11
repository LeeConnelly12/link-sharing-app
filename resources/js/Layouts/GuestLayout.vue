<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <main
    class="min-h-screen bg-light-gray px-8 pt-8 sm:grid sm:place-items-center"
  >
    <div class="mx-auto sm:w-[476px]">
      <div class="sm:text-center">
        <Link href="/" class="inline-block">
          <img
            src="/images/logo-devlinks-large.svg"
            width="183"
            height="40"
            alt="devlink's logo"
          />
        </Link>
      </div>
      <div class="mx-auto mt-16 sm:mt-12 sm:rounded-xl sm:bg-white sm:p-10">
        <slot />
      </div>
    </div>
  </main>
</template>
