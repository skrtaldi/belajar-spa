<template>
  <div class="p-6 max-w-5xl mx-auto bg-white shadow-md rounded mt-10">
    <h2 class="text-3xl font-bold text-center text-blue-700 mb-6">
      Daftar Biodata
    </h2>

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
            <td class="px-4 py-2 border text-center">
              <button
                class="text-sm bg-yellow-400 hover:bg-yellow-500 px-3 py-1 rounded text-white"
                @click="startEdit(item)"
              >
                Edit
              </button>
              <button
                class="text-sm bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-white"
                @click="confirmDelete(item.id)"
              >
                Hapus
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <p v-else class="text-center text-gray-600">Belum ada biodata yang tersedia.</p>

    <!-- Form Edit -->
    <div v-if="editing" class="mt-10 p-4 border-t pt-6">
      <h3 class="text-xl font-semibold mb-4 text-gray-800">Edit Biodata</h3>
      <form @submit.prevent="submitUpdate" class="grid gap-4 sm:grid-cols-2">
        <div>
          <label class="block text-sm font-medium mb-1">Nama</label>
          <input v-model="editForm.nama" class="w-full border p-2 rounded" required />
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Email</label>
          <input v-model="editForm.email" type="email" class="w-full border p-2 rounded" required />
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Umur</label>
          <input v-model="editForm.umur" type="number" class="w-full border p-2 rounded" required />
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Jenis Kelamin</label>
          <select v-model="editForm.gender" class="w-full border p-2 rounded" required>
            <option value="">Pilih jenis kelamin</option>
            <option>Laki-laki</option>
            <option>Perempuan</option>
          </select>
        </div>
        <div class="sm:col-span-2 flex gap-2">
          <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded" type="submit">Simpan</button>
          <button class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded" @click="cancelEdit">Batal</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const biodataList = ref([])
const editing = ref(false)
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

const startEdit = (item) => {
  editing.value = true
  editForm.value = { ...item } // copy data ke form
}

const cancelEdit = () => {
  editing.value = false
  editForm.value = {
    id: null,
    nama: '',
    email: '',
    umur: '',
    gender: ''
  }
}

const submitUpdate = async () => {
  try {
    await axios.put(`/biodata/${editForm.value.id}`, editForm.value)
    await fetchData()
    cancelEdit()
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
      console.error('Gagal menghapus:', err)
    }
  }
}
</script>
