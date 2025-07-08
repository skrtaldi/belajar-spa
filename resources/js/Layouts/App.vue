<template>
  <div class="container mt-4">
    <h1>Laravel + Vue SPA</h1>
    <router-link to="/">Home</router-link> |
    <router-link to="/produk">Produk</router-link> |
    <router-link to="/biodata">Biodata</router-link>
    <hr>
    <router-view></router-view>
  </div>
</template>

<script setup>
// Tidak perlu apa-apa di sini untuk sekarang
</script>

<style>
/* Tambahkan styling opsional di sini */
</style>
