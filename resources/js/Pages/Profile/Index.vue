<script setup>
import Layout from '@/Layouts/AuthenticatedLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { useForm, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'
import { ref } from 'vue'

const user = computed(() => usePage().props.auth.user)

const form = useForm({
  profile_picture: null,
  first_name: user.value.first_name,
  last_name: user.value.last_name,
  email: user.value.email,
})

const url = ref(user.value.profile_picture)

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
    <form @submit.prevent="submit" class="rounded-xl bg-white py-4">
      <div class="px-6">
        <div class="rounded-xl bg-light-gray p-5">
          <label for="profile_picture">Profile picture</label>
          <label
            v-if="!url"
            class="relative mt-4 grid h-48 w-48 cursor-pointer place-items-center rounded-xl bg-light-purple text-purple"
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
          <label v-else class="relative mt-4 block h-48 w-48">
            <input
              type="file"
              accept=".png,.jpg"
              class="hidden"
              id="profile_picture"
              @input="profilePictureChanged($event.target.files[0])"
            />
            <img :src="url" alt="" class="h-full w-full object-cover" />
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
          <p class="mt-6 text-xs">
            Image must be below 1024x1024px. Use PNG or JPG format.
          </p>
        </div>
      </div>

      <div class="mt-6 px-6">
        <div class="rounded-xl bg-light-gray p-5">
          <!-- First name -->
          <div>
            <label for="first_name" class="text-xs">First name</label>
            <input
              v-model="form.first_name"
              type="text"
              class="w-full rounded-lg border-0"
              id="first_name"
              required
            />
            <p v-if="form.errors.first_name" class="mt-1 text-xs text-red-500">
              {{ form.errors.first_name }}
            </p>
          </div>

          <!-- Last name -->
          <div class="mt-3">
            <label for="last_name" class="text-xs">Last name</label>
            <input
              v-model="form.last_name"
              type="text"
              class="w-full rounded-lg border-0"
              id="last_name"
              required
            />
            <p v-if="form.errors.last_name" class="mt-1 text-xs text-red-500">
              {{ form.errors.last_name }}
            </p>
          </div>

          <!-- Email -->
          <div class="mt-3">
            <label for="email" class="text-xs">Email</label>
            <input
              v-model="form.email"
              type="email"
              class="w-full rounded-lg border-0"
              id="email"
              required
            />
            <p v-if="form.errors.email" class="mt-1 text-xs text-red-500">
              {{ form.errors.email }}
            </p>
          </div>
        </div>
      </div>

      <hr class="mt-6 bg-borders" />

      <div class="mt-4 px-6">
        <PrimaryButton
          :disabled="form.processing"
          :loading="form.processing"
          type="submit"
        >
          Save
        </PrimaryButton>
      </div>
    </form>
  </Layout>
</template>
