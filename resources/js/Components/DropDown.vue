<script setup>
import { ref } from 'vue'
import { vOnClickOutside } from '@vueuse/components'
import { getGrayIconForPlatform } from '@/platforms'

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
  error: {
    type: String,
    required: false,
  },
})

defineOptions({
  inheritAttrs: false,
})

const open = ref(false)

const ignoreElement = ref(null)

defineEmits(['update:modelValue'])
</script>

<template>
  <div
    :class="$attrs.class"
    v-on-click-outside="() => (open = false)"
    class="relative"
    ref="ignoreElement"
  >
    <p class="text-xs">{{ label }}</p>
    <label
      class="relative mt-1 flex h-12 w-full items-center justify-between rounded-lg border border-borders bg-white px-4"
      :class="{ 'border-red': error }"
      v-bind="{ ...$attrs, class: null }"
    >
      <div v-if="modelValue" class="flex gap-x-3">
        <img
          :src="getGrayIconForPlatform(modelValue)"
          :alt="`${modelValue}'s logo'`"
        />
        <p>{{ modelValue }}</p>
      </div>
      <p v-else class="text-dark-gray/50">{{ placeholder }}</p>
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
      <div v-show="error" class="absolute right-10">
        <p class="pointer-events-none text-sm text-red">
          {{ error }}
        </p>
      </div>
    </label>
    <ul
      v-if="open"
      class="absolute left-0 right-0 top-full z-10 mt-2 grid max-h-[195px] gap-[1px] overflow-hidden overflow-y-auto rounded-lg bg-light-gray shadow-lg"
      tabindex="-1"
    >
      <li v-for="option in options" :key="option" class="bg-white">
        <button
          @click="$emit('update:modelValue', option), (open = false)"
          type="button"
          class="flex h-full w-full gap-x-3 px-4 py-3 text-left"
        >
          <img
            :src="getGrayIconForPlatform(option)"
            width="16"
            height="16"
            :alt="`${modelValue}'s logo'`"
          />
          {{ option }}
        </button>
      </li>
    </ul>
  </div>
</template>
