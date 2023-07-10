<script setup>
import Layout from '@/Layouts/AuthenticatedLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import Phone from '@/Components/Phone.vue'
import { useForm, usePage, Link, Head } from '@inertiajs/vue3'
import { computed } from 'vue'
import { ref } from 'vue'
import TextInput from '@/Components/TextInput.vue'

const user = computed(() => usePage().props.auth.user)

const form = useForm({
  profile_picture: null,
  first_name: user.value.first_name,
  last_name: user.value.last_name,
  email: user.value.email,
})

const url = ref(user.value.profile_picture)
form.profile_picture = url.value

async function submit() {
  form.post('/profile')
}

function profilePictureChanged(file) {
  url.value = URL.createObjectURL(file)
  form.profile_picture = file
}
</script>

<template>
  <Layout>
    <Head title="Profile" />

    <div class="lg:grid lg:grid-cols-2 lg:gap-x-6 xl:grid-cols-[1fr_1.5fr]">
      <div class="hidden place-items-center rounded-xl bg-white lg:grid">
        <Phone :user="{ ...form, profile_picture: url }" :links="user.links" />
      </div>
      <form
        @submit.prevent="submit"
        class="grid grid-rows-[auto_1fr_auto] rounded-xl bg-white lg:h-[819px]"
      >
        <div class="px-6 sm:px-10 sm:pt-10">
          <h1 class="text-2xl font-bold text-dark-gray sm:text-[2rem]">
            Profile Details
          </h1>
          <p class="sm:mt-4">
            Add your details to create a personal touch to your profile.
          </p>
          <div
            class="mt-10 rounded-xl bg-light-gray p-5 md:grid md:grid-cols-[2fr_1fr_1fr] md:items-center md:gap-x-6 lg:grid-cols-1 xl:grid-cols-[2fr_1fr_1fr]"
          >
            <div>
              <label for="profile_picture">Profile picture</label>
            </div>
            <label
              v-if="!url"
              class="relative mt-4 grid h-48 w-48 cursor-pointer place-items-center rounded-xl bg-light-purple text-purple md:mt-0"
            >
              <input
                type="file"
                accept=".png,.jpg"
                class="hidden"
                id="profile_picture"
                @input="profilePictureChanged($event.target.files[0])"
              />
              <div>
                <svg
                  class="mx-auto"
                  width="40"
                  height="40"
                  fill="none"
                  viewBox="0 0 40 40"
                >
                  <path
                    fill="#633CFF"
                    d="M33.75 6.25H6.25a2.5 2.5 0 0 0-2.5 2.5v22.5a2.5 2.5 0 0 0 2.5 2.5h27.5a2.5 2.5 0 0 0 2.5-2.5V8.75a2.5 2.5 0 0 0-2.5-2.5Zm0 2.5v16.055l-4.073-4.072a2.5 2.5 0 0 0-3.536 0l-3.125 3.125-6.875-6.875a2.5 2.5 0 0 0-3.535 0L6.25 23.339V8.75h27.5ZM6.25 26.875l8.125-8.125 12.5 12.5H6.25v-4.375Zm27.5 4.375h-3.34l-5.624-5.625L27.91 22.5l5.839 5.84v2.91ZM22.5 15.625a1.875 1.875 0 1 1 3.75 0 1.875 1.875 0 0 1-3.75 0Z"
                  />
                </svg>
                <p class="mt-2 font-semibold">+ Upload Image</p>
              </div>
            </label>
            <label
              v-else
              class="relative mt-4 block h-48 w-48 overflow-hidden rounded-xl md:mt-0 lg:mt-4 xl:mt-0"
            >
              <input
                type="file"
                accept=".png,.jpg"
                class="hidden"
                id="profile_picture"
                @input="profilePictureChanged($event.target.files[0])"
              />
              <img
                :src="url"
                width="192"
                height="192"
                alt=""
                class="h-full w-full object-cover"
              />
              <div
                class="absolute inset-0 grid cursor-pointer place-items-center bg-black/40 text-white opacity-0 hover:opacity-100"
              >
                <div>
                  <svg
                    class="mx-auto"
                    width="40"
                    height="40"
                    fill="none"
                    viewBox="0 0 40 40"
                  >
                    <path
                      fill="currentColor"
                      d="M33.75 6.25H6.25a2.5 2.5 0 0 0-2.5 2.5v22.5a2.5 2.5 0 0 0 2.5 2.5h27.5a2.5 2.5 0 0 0 2.5-2.5V8.75a2.5 2.5 0 0 0-2.5-2.5Zm0 2.5v16.055l-4.073-4.072a2.5 2.5 0 0 0-3.536 0l-3.125 3.125-6.875-6.875a2.5 2.5 0 0 0-3.535 0L6.25 23.339V8.75h27.5ZM6.25 26.875l8.125-8.125 12.5 12.5H6.25v-4.375Zm27.5 4.375h-3.34l-5.624-5.625L27.91 22.5l5.839 5.84v2.91ZM22.5 15.625a1.875 1.875 0 1 1 3.75 0 1.875 1.875 0 0 1-3.75 0Z"
                    />
                  </svg>
                  <p class="mt-2 font-semibold">+ Upload Image</p>
                </div>
              </div>
            </label>
            <p class="mt-6 text-xs md:mt-0 lg:mt-6 xl:mt-0">
              Image must be below 1024x1024px. Use PNG or JPG format.
            </p>
            <p
              v-if="form.errors.profile_picture"
              class="text-red-500 mt-1 text-xs"
            >
              {{ form.errors.profile_picture }}
            </p>
          </div>
        </div>

        <div class="mt-6 px-6 sm:px-10">
          <div class="rounded-xl bg-light-gray p-5">
            <div>
              <TextInput
                id="first_name"
                type="text"
                class="mt-1 block w-full"
                placeholder=".e.g. John"
                label="First name"
                v-model="form.first_name"
                :error="form.errors.first_name"
              />
            </div>

            <div class="mt-3">
              <TextInput
                id="last_name"
                type="text"
                class="mt-1 block w-full"
                placeholder="e.g. Doe"
                label="Last name"
                v-model="form.last_name"
                :error="form.errors.last_name"
              />
            </div>

            <div class="mt-3">
              <TextInput
                id="email"
                type="email"
                class="mt-1 block w-full"
                placeholder="e.g. alex@email.com"
                label="Email"
                v-model="form.email"
                :error="form.errors.email"
              />
            </div>
          </div>
        </div>

        <div
          class="mt-6 rounded-bl-xl rounded-br-xl border-t border-borders bg-white px-6 pb-4 pt-6 sm:px-10 sm:pb-6 sm:text-right"
        >
          <PrimaryButton class="sm:w-28" :loading="form.processing">
            Save
          </PrimaryButton>
        </div>
      </form>
    </div>
  </Layout>
</template>
