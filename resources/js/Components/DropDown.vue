<script setup>
import { ref } from 'vue'
import { vOnClickOutside } from '@vueuse/components'

defineProps({
  modelValue: {
    type: String,
    required: true,
  },
  label: {
    type: String,
    required: true,
  },
  options: {
    type: Array,
    required: true,
  },
  placeholder: {
    type: String,
    required: false,
  },
})

const open = ref(false)

const ignoreElement = ref(null)

defineEmits(['update:modelValue'])

function close() {
  open.value = false
}
</script>

<template>
  <div
    v-on-click-outside="() => (open = false)"
    class="relative"
    ref="ignoreElement"
  >
    <p class="text-xs">{{ label }}</p>
    <label
      :for="`platform_${index}`"
      class="flex h-10 w-full items-center justify-between rounded-lg bg-white px-4"
    >
      <p>{{ modelValue ? modelValue : placeholder }}</p>
      <svg
        class="transform"
        :class="{ 'rotate-180': open }"
        width="14"
        height="9"
        fill="none"
        viewBox="0 0 14 9"
      >
        <path stroke="#633CFF" stroke-width="2" d="m1 1 6 6 6-6" />
      </svg>
      <button
        @click="open = !open"
        type="button"
        class="absolute inset-0 h-full w-full"
      ></button>
    </label>
    <ul
      v-if="open"
      class="absolute left-0 right-0 top-full mt-2 grid max-h-[195px] gap-[1px] overflow-hidden overflow-y-auto rounded-lg bg-gray-100 shadow-sm"
    >
      <li v-for="option in options" :key="option" class="bg-white">
        <button
          @click="$emit('update:modelValue', option), (open = false)"
          type="button"
          class="h-full w-full px-4 py-3 text-left"
        >
          {{ option }}
        </button>
      </li>
    </ul>
  </div>
</template>
