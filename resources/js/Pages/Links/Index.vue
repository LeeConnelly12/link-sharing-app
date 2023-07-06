<script setup>
import Layout from '@/Layouts/AuthenticatedLayout.vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  links: Array,
})

const form = useForm({
  links: props.links,
})

function addLink() {
  form.links.push({
    platform: '',
    url: '',
  })
}

function removeLink(index) {
  form.links.splice(index, 1)
}

function submit() {
  form.post('/links')
}
</script>

<template>
  <Layout>
    <form @submit.prevent="submit" class="rounded-xl bg-white p-6">
      <h1>Customize your links</h1>
      <p>
        Add/edit/remove links below and then share all your profiles with the
        world!
      </p>

      <button @click="addLink" type="button">+ Add new link</button>

      <ul class="grid gap-y-6">
        <li
          v-for="(link, index) in form.links"
          :key="link.id"
          class="grid grid-cols-2 rounded-xl bg-gray-100 p-5"
        >
          <p>Link #{{ index + 1 }}</p>
          <button @click="removeLink(index)" class="text-right" type="button">
            Remove
          </button>

          <!-- Platform -->
          <div class="col-span-full mt-3">
            <label :for="`platform_${index}`" class="text-xs">Platform</label>
            <input
              v-model="link.platform"
              type="text"
              class="rounded-lg border-0"
              :id="`platform_${index}`"
            />
            <p
              v-if="form.errors[`links.${index}.platform`]"
              class="mt-1 text-xs text-red-500"
            >
              {{ form.errors[`links.${index}.platform`] }}
            </p>
          </div>

          <!-- Link -->
          <div class="col-span-full mt-3">
            <label :for="`link_${index}`" class="text-xs">Link</label>
            <input
              v-model="link.url"
              type="text"
              class="rounded-lg border-0"
              :id="`link_${index}`"
            />
            <p
              v-if="form.errors[`links.${index}.url`]"
              class="mt-1 text-xs text-red-500"
            >
              {{ form.errors[`links.${index}.url`] }}
            </p>
          </div>
        </li>
      </ul>

      <button type="submit">Save</button>
    </form>
  </Layout>
</template>
