<script setup>
import Layout from '@/Layouts/GuestLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

const form = useForm({
  email: '',
  password: '',
  password_confirmation: '',
})

const submit = () => {
  form.post('/register', {
    onFinish: () => form.reset('password', 'password_confirmation'),
  })
}
</script>

<template>
  <Layout>
    <Head title="Create Account" />

    <h1 class="text-2xl font-bold text-dark-gray">Create account</h1>
    <p class="mt-2">Let's get you started sharing your links!</p>

    <form @submit.prevent="submit" class="mt-10">
      <div>
        <label class="block text-xs text-dark-gray" for="email">
          Email address
        </label>

        <input
          class="mt-2 h-12 w-full rounded-lg border border-borders px-4 placeholder:text-dark-gray/50"
          placeholder="e.g. alex@email.com"
          id="email"
          type="email"
          v-model="form.email"
          required
          autocomplete="username"
        />

        <p v-if="form.errors.email" class="mt-2 text-xs text-red-500">
          {{ form.errors.email }}
        </p>
      </div>

      <div class="mt-6">
        <label class="block text-xs text-dark-gray" for="password">
          Password
        </label>

        <input
          id="password"
          class="mt-2 h-12 w-full rounded-lg border border-borders px-4 placeholder:text-dark-gray/50"
          placeholder="Enter your password"
          type="password"
          v-model="form.password"
          autocomplete="new-password"
        />

        <p v-if="form.errors.password" class="mt-2 text-xs text-red-500">
          {{ form.errors.password }}
        </p>
      </div>

      <div class="mt-6">
        <label class="block text-xs text-dark-gray" for="password_confirmation">
          Confirm Password
        </label>

        <input
          id="password_confirmation"
          class="mt-2 h-12 w-full rounded-lg border border-borders px-4 placeholder:text-dark-gray/50"
          placeholder="At least 8 characters"
          type="password"
          v-model="form.password_confirmation"
          autocomplete="new-password"
        />

        <p
          v-if="form.errors.password_confirmation"
          class="mt-2 text-xs text-red-500"
        >
          {{ form.errors.password_confirmation }}
        </p>
      </div>

      <div class="mt-6">
        <p class="text-xs">Password must contain at least 8 characters</p>
      </div>

      <div class="mt-6">
        <PrimaryButton :loading="form.processing">
          Create new account
        </PrimaryButton>
      </div>

      <div class="mt-6 text-center sm:flex sm:justify-center sm:gap-x-1">
        <p>Already have an account?</p>
        <Link
          href="/login"
          class="rounded-md text-purple focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
          Login
        </Link>
      </div>
    </form>
  </Layout>
</template>
