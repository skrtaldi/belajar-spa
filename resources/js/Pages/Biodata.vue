<template>
  <div class="p-6 max-w-md mx-auto bg-white shadow rounded">
    <h2 class="text-2xl font-bold mb-4">Form Biodata</h2>

    <form @submit.prevent="submitForm" class="space-y-4">
      <div>
        <label class="block mb-1 font-semibold">Nama:</label>
        <input v-model="form.nama" class="w-full border p-2 rounded" required />
      </div>

      <div>
        <label class="block mb-1 font-semibold">Email:</label>
        <input v-model="form.email" type="email" class="w-full border p-2 rounded" required />
      </div>

      <div>
        <label class="block mb-1 font-semibold">Umur:</label>
        <input v-model="form.umur" type="number" class="w-full border p-2 rounded" required />
      </div>

      <div>
        <label class="block mb-1 font-semibold">Jenis Kelamin:</label>
        <select v-model="form.gender" class="w-full border p-2 rounded" required>
          <option value="" disabled>Pilih jenis kelamin</option>
          <option>Laki-laki</option>
          <option>Perempuan</option>
        </select>
      </div>

      <button class="bg-blue-500 text-white px-4 py-2 rounded">Kirim</button>
    </form>

    <div v-if="submitted" class="mt-6 p-4 border rounded bg-gray-50">
      <h3 class="text-xl font-semibold mb-2">Hasil Biodata:</h3>
      <p><strong>Nama:</strong> {{ form.nama }}</p>
      <p><strong>Email:</strong> {{ form.email }}</p>
      <p><strong>Umur:</strong> {{ form.umur }}</p>
      <p><strong>Jenis Kelamin:</strong> {{ form.gender }}</p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const form = ref({
  nama: '',
  email: '',
  umur: '',
  gender: ''
})

const submitted = ref(false)

const submitForm = async () => {
  try {
    const res = await axios.post('/api/biodata', form.value)
    console.log('Berhasil:', res.data)
    submitted.value = true
  } catch (err) {
    console.error('Gagal simpan:', err.response?.data)
  }
}
</script>
