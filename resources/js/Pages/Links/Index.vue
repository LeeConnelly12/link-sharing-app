<script setup>
import Layout from '@/Layouts/AuthenticatedLayout.vue'
import DropDown from '@/Components/DropDown.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import Phone from '@/Components/Phone.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import { useForm, Head } from '@inertiajs/vue3'

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
    <Head title="Links" />

    <div
      class="lg:grid lg:grid-cols-2 lg:gap-x-6 xl:h-[834px] xl:grid-cols-[1fr_1.5fr]"
    >
      <div class="hidden place-items-center rounded-xl bg-white py-6 lg:grid">
        <Phone />
      </div>
      <form
        @submit.prevent="submit"
        class="rounded-xl bg-white py-4 sm:pb-6 sm:pt-10"
      >
        <div class="px-6 sm:px-10">
          <h1 class="text-2xl font-bold text-dark-gray sm:text-[2rem]">
            Customize your links
          </h1>
          <p class="sm:mt-4">
            Add/edit/remove links below and then share all your profiles with
            the world!
          </p>

          <SecondaryButton @click="addLink" class="mt-10">
            + Add new link
          </SecondaryButton>

          <section class="mt-6 grid gap-y-6" v-if="form.links.length > 0">
            <article
              v-for="(link, index) in form.links"
              :key="link.id"
              class="grid grid-cols-2 rounded-xl bg-light-gray p-5"
            >
              <p class="font-bold">Link #{{ index + 1 }}</p>
              <button
                @click="removeLink(index)"
                class="text-right"
                type="button"
              >
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
                  placeholder="e.g. https://www.github.com/johnappleseed"
                  class="h-12 w-full rounded-lg border border-borders px-4 placeholder:text-dark-gray/50"
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
          </section>

          <section
            v-else
            class="mt-6 grid h-[428px] place-items-center rounded-xl bg-light-gray px-5 text-center"
          >
            <div>
              <img
                src="/images/illustration-empty.svg"
                alt=""
                class="mx-auto px-8"
              />
              <h2
                class="mt-6 text-2xl font-bold text-dark-gray sm:mt-10 sm:text-[2rem]"
              >
                Let's get you started
              </h2>
              <p class="mt-6 sm:max-w-[488px]">
                Use the “Add new link” button to get started. Once you have more
                than one link, you can reorder and edit them. We’re here to help
                you share your profiles with everyone!
              </p>
            </div>
          </section>
        </div>

        <hr class="mt-6 bg-borders sm:mt-10" />

        <div class="mt-4 px-6 sm:mt-6 sm:px-10 sm:text-right">
          <PrimaryButton
            class="sm:w-28"
            :disabled="form.processing || (!links.length && !form.links.length)"
            :loading="form.processing"
          >
            Save
          </PrimaryButton>
        </div>
      </form>
    </div>
  </Layout>
</template>
