<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

const form = useForm({
  email: '',
  password: '',
})

const submit = () => {
  form.post('/login', {
    onFinish: () => form.reset('password'),
  })
}
</script>

<template>
  <GuestLayout>
    <Head title="Log in" />

    <h1 class="text-2xl font-bold text-dark-gray">Login</h1>
    <p class="mt-2">Add your details below to get back into the app</p>

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
          autofocus
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
          required
          autocomplete="current-password"
        />

        <p v-if="form.errors.password" class="mt-2 text-xs text-red-500">
          {{ form.errors.password }}
        </p>
      </div>

      <div class="mt-6">
        <PrimaryButton :loading="form.processing">Log in</PrimaryButton>
      </div>

      <div class="mt-6 text-center">
        <p>Don't have an account?</p>
        <Link href="/register" class="text-purple">Create account</Link>
      </div>
    </form>
  </GuestLayout>
</template>
