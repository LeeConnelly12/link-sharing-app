<script setup>
import Layout from '@/Layouts/AuthenticatedLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import Phone from '@/Components/Phone.vue'
import { useForm, usePage, Link, Head } from '@inertiajs/vue3'
import { computed } from 'vue'
import { ref } from 'vue'

const user = computed(() => usePage().props.auth.user)

const form = useForm({
  profile_picture: user.value.profile_picture,
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
    <Head title="Profile" />

    <div class="lg:grid lg:grid-cols-2 lg:gap-x-6 xl:grid-cols-[1fr_1.5fr]">
      <div class="hidden place-items-center rounded-xl bg-white lg:grid">
        <Phone :user="form" :links="user.links" />
      </div>
      <form @submit.prevent="submit" class="rounded-xl bg-white lg:h-[819px]">
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
            <p class="mt-6 text-xs md:mt-0 lg:mt-6 xl:mt-0">
              Image must be below 1024x1024px. Use PNG or JPG format.
            </p>
            <p
              v-if="form.errors.profile_picture"
              class="mt-1 text-xs text-red-500"
            >
              {{ form.errors.profile_picture }}
            </p>
          </div>
        </div>

        <div class="mt-6 px-6 sm:px-10">
          <div class="rounded-xl bg-light-gray p-5">
            <!-- First name -->
            <div>
              <label for="first_name" class="text-xs text-dark-gray"
                >First name</label
              >
              <input
                v-model="form.first_name"
                placeholder=".e.g. John"
                type="text"
                class="mt-1 h-12 w-full rounded-lg border border-borders px-4 placeholder:text-dark-gray/50"
                id="first_name"
                required
              />
              <p
                v-if="form.errors.first_name"
                class="mt-1 text-xs text-red-500"
              >
                {{ form.errors.first_name }}
              </p>
            </div>

            <!-- Last name -->
            <div class="mt-3">
              <label for="last_name" class="text-xs text-dark-gray"
                >Last name</label
              >
              <input
                v-model="form.last_name"
                placeholder="e.g. Doe"
                type="text"
                class="mt-1 h-12 w-full rounded-lg border border-borders px-4 placeholder:text-dark-gray/50"
                id="last_name"
                required
              />
              <p v-if="form.errors.last_name" class="mt-1 text-xs text-red-500">
                {{ form.errors.last_name }}
              </p>
            </div>

            <!-- Email -->
            <div class="mt-3">
              <label for="email" class="text-xs text-dark-gray">Email</label>
              <input
                v-model="form.email"
                placeholder="e.g. alex@email.com"
                type="email"
                class="mt-1 h-12 w-full rounded-lg border border-borders px-4 placeholder:text-dark-gray/50"
                id="email"
                required
              />
              <p v-if="form.errors.email" class="mt-1 text-xs text-red-500">
                {{ form.errors.email }}
              </p>
            </div>
          </div>
        </div>

        <div
          class="mt-6 rounded-bl-xl rounded-br-xl border-t border-borders bg-white px-6 pb-4 pt-6 sm:px-10 sm:pb-6 sm:text-right"
        >
          <PrimaryButton
            class="sm:w-28"
            :disabled="form.processing"
            :loading="form.processing"
          >
            Save
          </PrimaryButton>
        </div>
      </form>
    </div>

    <div class="mt-4 text-center sm:mt-6 sm:pr-10 sm:text-right">
      <Link
        :href="route('logout')"
        method="post"
        as="button"
        class="rounded-md text-purple focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
      >
        Log Out
      </Link>
    </div>
  </Layout>
</template>
