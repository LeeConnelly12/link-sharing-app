<script setup>
import Layout from '@/Layouts/GuestLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'

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
        <TextInput
          id="email"
          type="email"
          class="mt-1 block w-full"
          placeholder="e.g. alex@email.com"
          label="Email address"
          v-model="form.email"
          :error="form.errors.email"
          autocomplete="username"
        />
      </div>

      <div class="mt-6">
        <TextInput
          id="password"
          type="password"
          class="mt-1 block w-full"
          placeholder="At least 8 characters"
          label="Password"
          v-model="form.password"
          :error="form.errors.password"
          autocomplete="new-password"
        />
      </div>

      <div class="mt-6">
        <TextInput
          id="password_confirmation"
          type="password"
          class="mt-1 block w-full"
          placeholder="At least 8 characters"
          label="Confirm password"
          v-model="form.password_confirmation"
          :error="form.errors.password_confirmation"
          autocomplete="new-password"
        />
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
