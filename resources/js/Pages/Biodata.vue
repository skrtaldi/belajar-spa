<template>
  <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-md mt-10">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-bold text-blue-700">Daftar Biodata</h2>
      <button
        @click="openModal"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded"
      >
        + Tambah Biodata
      </button>
    </div>

    <!-- Tabel Data -->
    <div v-if="dataList.length > 0">
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
    <p v-else class="text-gray-600 text-center mt-4">Belum ada data biodata.</p>

    <!-- Modal Tambah -->
    <div
      v-if="showModal"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
    >
      <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-xl font-semibold text-gray-800">Tambah Biodata</h3>
          <button @click="closeModal" class="text-gray-500 hover:text-red-500 text-xl">&times;</button>
        </div>
        <form @submit.prevent="submitForm" class="space-y-4">
          <div>
            <label class="block mb-1 font-semibold text-gray-700">Nama</label>
            <input v-model="form.nama" class="w-full border border-gray-300 p-2 rounded" required />
          </div>

          <div>
            <label class="block mb-1 font-semibold text-gray-700">Email</label>
            <input v-model="form.email" type="email" class="w-full border border-gray-300 p-2 rounded" required />
          </div>

          <div>
            <label class="block mb-1 font-semibold text-gray-700">Umur</label>
            <input v-model="form.umur" type="number" class="w-full border border-gray-300 p-2 rounded" required />
          </div>

          <div>
            <label class="block mb-1 font-semibold text-gray-700">Jenis Kelamin</label>
            <select v-model="form.gender" class="w-full border border-gray-300 p-2 rounded" required>
              <option value="" disabled>Pilih jenis kelamin</option>
              <option>Laki-laki</option>
              <option>Perempuan</option>
            </select>
          </div>

          <div class="flex justify-end space-x-2">
            <button
              type="button"
              @click="closeModal"
              class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded"
            >
              Batal
            </button>
            <button
              type="submit"
              class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded"
            >
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

// Modal
const showModal = ref(false)
const openModal = () => (showModal.value = true)
const closeModal = () => (showModal.value = false)

// Form data
const form = ref({
  nama: '',
  email: '',
  umur: '',
  gender: ''
})

// Daftar biodata
const dataList = ref([])

// Fetch awal (opsional, bisa juga langsung dari backend)
const fetchData = async () => {
  try {
    const res = await axios.get('/biodata')
    dataList.value = res.data
  } catch (err) {
    console.error('Gagal ambil data:', err)
  }
}
onMounted(fetchData)

const submitForm = async () => {
  try {
    const res = await axios.post('/biodata', form.value)
    console.log('Berhasil:', res.data)

    // Tambahkan ke daftar tanpa reload
    dataList.value.push({ ...form.value })

    // Reset form dan tutup modal
    form.value = { nama: '', email: '', umur: '', gender: '' }
    closeModal()
  } catch (err) {
    console.error('Gagal simpan:', err.response?.data)
  }
}
</script>
