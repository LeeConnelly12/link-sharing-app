<script setup>
defineProps({
  type: {
    type: String,
    default: 'button',
  },
  loading: {
    type: Boolean,
    required: false,
    default: false,
  },
})
</script>

<template>
  <button
    :type="type"
    class="inline-flex inline-flex h-[46px] w-full items-center justify-center rounded-lg border border-purple bg-white px-4 font-semibold text-purple shadow-sm transition duration-150 ease-in-out hover:bg-light-purple focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25"
  >
    <slot />
  </button>
</template>
