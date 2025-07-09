<template>
  <div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-md mt-10">
    <h2 class="text-2xl font-bold mb-6 text-center text-blue-700">Form Biodata</h2>

    <!-- Form -->
    <form @submit.prevent="submitForm" class="space-y-4">
      <div>
        <label class="block mb-1 font-semibold text-gray-700">Nama</label>
        <input v-model="form.nama" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300" required />
      </div>

      <div>
        <label class="block mb-1 font-semibold text-gray-700">Email</label>
        <input v-model="form.email" type="email" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300" required />
      </div>

      <div>
        <label class="block mb-1 font-semibold text-gray-700">Umur</label>
        <input v-model="form.umur" type="number" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300" required />
      </div>

      <div>
        <label class="block mb-1 font-semibold text-gray-700">Jenis Kelamin</label>
        <select v-model="form.gender" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300" required>
          <option value="" disabled>Pilih jenis kelamin</option>
          <option>Laki-laki</option>
          <option>Perempuan</option>
        </select>
      </div>

      <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-200">
        Kirim
      </button>
    </form>

    <!-- Tabel Data -->
    <div v-if="dataList.length > 0" class="mt-10">
      <h3 class="text-xl font-semibold mb-4 text-gray-800">Daftar Biodata</h3>
      <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left border border-gray-200 rounded-md overflow-hidden">
          <thead class="bg-blue-100 text-blue-800">
            <tr>
              <th class="px-4 py-2 border">Nama</th>
              <th class="px-4 py-2 border">Email</th>
              <th class="px-4 py-2 border">Umur</th>
              <th class="px-4 py-2 border">Gender</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in dataList" :key="index" class="bg-white hover:bg-gray-50">
              <td class="px-4 py-2 border">{{ item.nama }}</td>
              <td class="px-4 py-2 border">{{ item.email }}</td>
              <td class="px-4 py-2 border">{{ item.umur }}</td>
              <td class="px-4 py-2 border">{{ item.gender }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

// Form data
const form = ref({
  nama: '',
  email: '',
  umur: '',
  gender: ''
})

// Daftar biodata yang dikirim
const dataList = ref([])

const submitForm = async () => {
  try {
    const res = await axios.post('/biodata', form.value)
    console.log('Berhasil:', res.data)

    // Tambahkan ke daftar biodata
    dataList.value.push({ ...form.value })

    // Reset form
    form.value = {
      nama: '',
      email: '',
      umur: '',
      gender: ''
    }
  } catch (err) {
    console.error('Gagal simpan:', err.response?.data)
  }
}
</script>
