<template>
  <div>
    <h2>Daftar Produk</h2>

    <form @submit.prevent="submitForm">
      <input v-model="form.nama" placeholder="Nama Produk" required>
      <input v-model="form.harga" type="number" placeholder="Harga" required>
      <button type="submit">{{ form.id ? 'Update' : 'Tambah' }}</button>
    </form>

    <ul v-if="produks.length > 0">
      <li v-for="p in produks" :key="p.id">
        {{ p.nama }} - Rp{{ p.harga }}
        <button @click="editProduk(p)">Edit</button>
        <button @click="hapusProduk(p.id)">Hapus</button>
      </li>
    </ul>

    <p v-else class="text-gray-500 mt-4">Belum ada produk.</p>

  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const produks = ref([])
const form = ref({ id: null, nama: '', harga: '' })

const getProduks = async () => {
  const res = await axios.get('/api/produk')
  produks.value = res.data
}

const submitForm = async () => {
  if (form.value.id) {
    await axios.put(`/api/produk/${form.value.id}`, form.value)
  } else {
    await axios.post('/api/produk', form.value)
  }
  form.value = { id: null, nama: '', harga: '' }
  getProduks()
}

const editProduk = (p) => {
  form.value = { ...p }
}

const hapusProduk = async (id) => {
  await axios.delete(`/api/produk/${id}`)
  getProduks()
}

onMounted(getProduks)
</script>
