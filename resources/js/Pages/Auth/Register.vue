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
        <InputLabel for="email" value="Email address" />

        <TextInput
          id="email"
          type="email"
          class="mt-1 block w-full"
          placeholder="e.g. alex@email.com"
          v-model="form.email"
          required
          autocomplete="username"
        />

        <InputError class="mt-2" :message="form.errors.email" />
      </div>

      <div class="mt-6">
        <InputLabel for="password" value="Password" />

        <TextInput
          id="password"
          type="password"
          class="mt-1 block w-full"
          placeholder="At least 8 characters"
          v-model="form.password"
          required
          autocomplete="new-password"
        />

        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <div class="mt-6">
        <InputLabel for="password_confirmation" value="Confirm Password" />

        <TextInput
          id="password_confirmation"
          type="password"
          class="mt-1 block w-full"
          placeholder="At least 8 characters"
          v-model="form.password_confirmation"
          required
          autocomplete="new-password"
        />

        <InputError class="mt-2" :message="form.errors.password_confirmation" />
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
