<script setup>
import Layout from '@/Layouts/AuthenticatedLayout.vue'
import DropDown from '@/Components/DropDown.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import { useForm } from '@inertiajs/vue3'

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
    <form @submit.prevent="submit" class="rounded-xl bg-white py-4">
      <div class="px-6">
        <h1 class="text-2xl font-bold text-dark-gray">Customize your links</h1>
        <p>
          Add/edit/remove links below and then share all your profiles with the
          world!
        </p>

        <SecondaryButton @click="addLink" class="mt-10">
          + Add new link
        </SecondaryButton>

        <div class="mt-6 grid gap-y-6" v-if="form.links.length > 0">
          <article
            v-for="(link, index) in form.links"
            :key="link.id"
            class="grid grid-cols-2 rounded-xl bg-light-gray p-5"
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

        <section
          v-else
          class="mt-6 h-[428px] rounded-xl bg-light-gray px-5 pt-9 text-center"
        >
          <img
            src="/images/illustration-empty.svg"
            alt=""
            class="mx-auto px-8"
          />
          <h2 class="mt-6 text-2xl font-bold text-dark-gray">
            Let's get you started
          </h2>
          <p class="mt-6">
            Use the “Add new link” button to get started. Once you have more
            than one link, you can reorder and edit them. We’re here to help you
            share your profiles with everyone!
          </p>
        </section>
      </div>

      <hr class="mt-6 bg-borders" />

      <div class="mt-4 px-6">
        <PrimaryButton
          :disabled="!links.length && !form.links.length"
          :loading="form.processing"
          type="submit"
        >
          Save
        </PrimaryButton>
      </div>
    </form>
  </Layout>
</template>
