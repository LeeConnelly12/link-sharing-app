<script setup>
defineProps({
  type: {
    type: String,
    default: 'submit',
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
    class="inline-flex h-[46px] w-full items-center justify-center rounded-lg border border-transparent bg-purple px-4 font-semibold text-white transition duration-150 ease-in-out hover:bg-purple-hover-color focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-purple-hover-color disabled:bg-purple-hover-color"
  >
    <div v-if="loading" class="btn-spinner"></div>
    <slot v-else />
  </button>
</template>
