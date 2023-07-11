<script setup>
import Layout from '@/Layouts/GuestLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue'

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
  <Layout>
    <Head title="Log in" />

    <h1 class="text-2xl font-bold text-dark-gray">Login</h1>
    <p class="mt-2">Add your details below to get back into the app</p>

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
          icon="/images/icon-email.svg"
          autocomplete="username"
        />
      </div>

      <div class="mt-6">
        <TextInput
          id="password"
          type="password"
          class="mt-1 block w-full"
          placeholder="Enter your password"
          label="Password"
          v-model="form.password"
          :error="form.errors.password"
          icon="/images/icon-password.svg"
          autocomplete="current-password"
        />
      </div>

      <div class="mt-6">
        <PrimaryButton :loading="form.processing">Log in</PrimaryButton>
      </div>

      <div class="mt-6 text-center sm:flex sm:justify-center sm:gap-x-1">
        <p>Don't have an account?</p>
        <Link href="/register" class="text-purple">Create account</Link>
      </div>
    </form>
  </Layout>
</template>
