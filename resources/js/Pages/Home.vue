<template>
  <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-md mt-10">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-bold text-blue-700">Daftar Biodata</h2>
      <button
        @click="openAddModal"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded"
      >
        + Tambah Biodata
      </button>
    </div>

    <!-- Tabel Biodata -->
    <div v-if="biodataList.length > 0" class="overflow-x-auto">
      <table class="min-w-full text-sm border border-gray-300 rounded">
        <thead class="bg-blue-100 text-blue-800">
          <tr>
            <th class="px-6 py-3 border">No</th>
            <th class="px-6 py-3 border">Nama</th>
            <th class="px-6 py-3 border">Email</th>
            <th class="px-6 py-3 border">Umur</th>
            <th class="px-6 py-3 border">Gender</th>
            <th class="px-6 py-3 border">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(item, index) in biodataList"
            :key="item.id"
            class="bg-white even:bg-gray-50 hover:bg-gray-100"
          >
            <td class="px-4 py-2 border text-center">{{ index + 1 }}</td>
            <td class="px-4 py-2 border">{{ item.nama }}</td>
            <td class="px-4 py-2 border">{{ item.email }}</td>
            <td class="px-4 py-2 border text-center">{{ item.umur }}</td>
            <td class="px-4 py-2 border text-center">{{ item.gender }}</td>
            <td class="px-4 py-2 border text-center space-x-2">
              <button
                class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded"
                @click="openEditModal(item)"
              >
                Edit
              </button>
              <button
                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded"
                @click="confirmDelete(item.id)"
              >
                Hapus
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Modal Tambah -->
    <div
      v-if="showAddModal"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
    >
      <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-xl font-semibold text-gray-800">Tambah Biodata</h3>
          <button @click="closeAddModal" class="text-gray-500 hover:text-red-500 text-xl">&times;</button>
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
            <button type="button" @click="closeAddModal" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded">
              Batal
            </button>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal Edit -->
    <div
      v-if="showEditModal"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
    >
      <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h3 class="text-xl font-bold mb-4 text-gray-800">Edit Biodata</h3>
        <form @submit.prevent="submitUpdate" class="space-y-4">
          <div>
            <label class="block mb-1">Nama</label>
            <input v-model="editForm.nama" class="w-full border p-2 rounded" />
          </div>
          <div>
            <label class="block mb-1">Email</label>
            <input v-model="editForm.email" class="w-full border p-2 rounded" />
          </div>
          <div>
            <label class="block mb-1">Umur</label>
            <input v-model="editForm.umur" type="number" class="w-full border p-2 rounded" />
          </div>
          <div>
            <label class="block mb-1">Jenis Kelamin</label>
            <select v-model="editForm.gender" class="w-full border p-2 rounded">
              <option value="">Pilih</option>
              <option>Laki-laki</option>
              <option>Perempuan</option>
            </select>
          </div>
          <div class="flex justify-end space-x-2">
            <button type="button" @click="closeEditModal" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded">
              Batal
            </button>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
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

const biodataList = ref([])

// Modal flags
const showAddModal = ref(false)
const showEditModal = ref(false)

// Data form tambah
const form = ref({
  nama: '',
  email: '',
  umur: '',
  gender: ''
})

// Data form edit
const editForm = ref({
  id: null,
  nama: '',
  email: '',
  umur: '',
  gender: ''
})

const fetchData = async () => {
  const res = await axios.get('/biodata')
  biodataList.value = res.data
}
onMounted(fetchData)

const openAddModal = () => (showAddModal.value = true)
const closeAddModal = () => {
  showAddModal.value = false
  form.value = { nama: '', email: '', umur: '', gender: '' }
}

const openEditModal = (item) => {
  editForm.value = { ...item }
  showEditModal.value = true
}
const closeEditModal = () => {
  showEditModal.value = false
  editForm.value = { id: null, nama: '', email: '', umur: '', gender: '' }
}

const submitForm = async () => {
  try {
    await axios.post('/biodata', form.value)
    await fetchData()
    closeAddModal()
  } catch (err) {
    console.error('Gagal simpan:', err.response?.data)
  }
}

const submitUpdate = async () => {
  try {
    await axios.put(`/biodata/${editForm.value.id}`, editForm.value)
    await fetchData()
    closeEditModal()
  } catch (err) {
    console.error('Gagal update:', err)
  }
}

const confirmDelete = async (id) => {
  if (confirm('Yakin ingin menghapus data ini?')) {
    try {
      await axios.delete(`/biodata/${id}`)
      await fetchData()
    } catch (err) {
      console.error('Gagal hapus:', err)
    }
  }
}
</script>
