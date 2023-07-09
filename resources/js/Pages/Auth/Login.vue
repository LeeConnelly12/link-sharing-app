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
        <InputLabel for="email" value="Email address" />

        <TextInput
          id="email"
          type="email"
          class="mt-1 block w-full"
          placeholder="e.g. alex@email.com"
          v-model="form.email"
          required
          autofocus
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
          placeholder="Enter your password"
          v-model="form.password"
          required
          autocomplete="current-password"
        />

        <InputError class="mt-2" :message="form.errors.password" />
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
