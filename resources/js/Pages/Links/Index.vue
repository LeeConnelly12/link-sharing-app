<script setup>
import Layout from '@/Layouts/AuthenticatedLayout.vue'
import DropDown from '@/Components/DropDown.vue'
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps({
  links: Array,
  platforms: Array,
  images: Array,
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

      <div class="grid gap-y-6">
        <article
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
            <DropDown
              v-model="link.platform"
              label="Platform"
              :options="platforms"
              placeholder="Select platform"
            />
          </div>

          <!-- Link -->
          <div class="col-span-full mt-3">
            <label :for="`link_${index}`" class="text-xs">Link</label>
            <input
              v-model="link.url"
              type="text"
              class="w-full rounded-lg border-0"
              :id="`link_${index}`"
              required
            />
            <p
              v-if="form.errors[`links.${index}.url`]"
              class="mt-1 text-xs text-red-500"
            >
              {{ form.errors[`links.${index}.url`] }}
            </p>
          </div>
        </article>
      </div>

      <button type="submit">Save</button>
    </form>
  </Layout>
</template>
