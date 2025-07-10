<template>
  <div class="min-h-screen bg-gray-100">
    <header class="bg-white shadow">
      <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-blue-700">Testing SPA</h1>
        <nav class="space-x-4">
          <router-link to="/" class="text-gray-700 hover:text-blue-600 font-medium">Home</router-link>
        </nav>
      </div>
    </header>

    <main class="container mx-auto px-6 py-8">
      <router-view />
    </main>
  </div>
</template>

<script setup>
// Kosongkan atau isi sesuai kebutuhan
</script>

<style scoped>
/* Tambahan jika perlu, namun sudah cukup dengan Tailwind */
</style>
