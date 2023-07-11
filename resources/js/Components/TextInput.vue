<script setup>
import { onMounted, ref } from 'vue'
import InputLabel from '@/Components/InputLabel.vue'

defineProps({
  modelValue: {
    type: String,
    required: true,
  },
  id: {
    type: String,
    required: true,
  },
  label: {
    type: String,
    required: true,
  },
  icon: {
    type: String,
    required: false,
  },
  error: {
    type: String,
    required: false,
  },
})

defineEmits(['update:modelValue'])

defineOptions({
  inheritAttrs: false,
})

const input = ref(null)

onMounted(() => {
  if (input.value.hasAttribute('autofocus')) {
    input.value.focus()
  }
})

defineExpose({ focus: () => input.value.focus() })
</script>

<template>
  <div :class="$attrs.class">
    <InputLabel :for="id" :value="label" :class="{ 'text-red': error }" />
    <div class="relative mt-2 flex items-center border-0 p-0">
      <img
        class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2"
        :src="icon"
        alt=""
      />

      <input
        v-bind="{ ...$attrs, class: null }"
        class="h-12 w-full rounded-lg border border-borders placeholder:text-dark-gray/50 focus:border-indigo-500 focus:ring-indigo-500"
        :class="{ 'border-red': error }, icon ? 'pl-11 pr-4' : 'px-4'"
        :value="modelValue"
        :id="id"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
      />

      <div v-show="error" class="absolute right-4">
        <p class="pointer-events-auto text-sm text-red">
          {{ error }}
        </p>
      </div>
    </div>
  </div>
</template>
