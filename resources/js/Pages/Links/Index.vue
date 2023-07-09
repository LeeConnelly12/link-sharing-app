<script setup>
import Layout from '@/Layouts/AuthenticatedLayout.vue'
import DropDown from '@/Components/DropDown.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import Phone from '@/Components/Phone.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import { useForm, Head, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'
import { SlickList, SlickItem, DragHandle } from 'vue-slicksort'

const props = defineProps({
  links: Array,
  platforms: Array,
  images: Array,
})

const user = computed(() => usePage().props.auth.user)

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

    <div class="lg:grid lg:grid-cols-2 lg:gap-x-6 xl:grid-cols-[1fr_1.5fr]">
      <div class="hidden place-items-center rounded-xl bg-white lg:grid">
        <Phone :user="user" :links="form.links" />
      </div>
      <form
        @submit.prevent="submit"
        class="grid min-h-[785px] grid-rows-[auto_1fr_auto] rounded-xl bg-white lg:h-[819px]"
      >
        <div class="px-6 pb-6 pt-6 sm:px-10 sm:pt-10">
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
        </div>

        <SlickList
          v-if="form.links.length > 0"
          axis="y"
          v-model:list="form.links"
          useDragHandle
          class="px-6 sm:px-10 lg:overflow-y-auto"
        >
          <SlickItem
            v-for="(link, index) in form.links"
            :key="link"
            :index="index"
            class="pb-6"
          >
            <article
              class="grid grid-cols-[auto_1fr_auto] items-center gap-x-2 rounded-xl bg-light-gray p-5"
            >
              <DragHandle class="cursor-pointer">
                <img
                  src="/images/icon-drag-and-drop.svg"
                  width="12"
                  height="6"
                  alt=""
                />
              </DragHandle>
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
          </SlickItem>
        </SlickList>

        <div v-else class="mb-6 px-5 text-center sm:px-10">
          <div
            class="grid h-full place-items-center rounded-xl bg-light-gray lg:px-10"
          >
            <div>
              <img
                src="/images/illustration-empty.svg"
                width="251"
                height="161"
                alt=""
                class="mx-auto"
              />
              <h2
                class="mt-6 text-2xl font-bold text-dark-gray sm:mt-10 sm:text-[2rem]"
              >
                Let's get you started
              </h2>
              <p class="mt-6 sm:max-w-[488px]">
                Use the “Add new link” button to get started. Once you have more
                than one link, you can reorder and edit them. We're here to help
                you share your profiles with everyone!
              </p>
            </div>
          </div>
        </div>

        <div
          class="rounded-bl-xl rounded-br-xl border-t border-borders bg-white px-6 pb-4 pt-6 sm:px-10 sm:pb-6 sm:text-right"
        >
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
