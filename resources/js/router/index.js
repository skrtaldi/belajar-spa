import { createRouter, createWebHistory } from 'vue-router'
import Home from '../Pages/Home.vue'
import Produk from '../Pages/Produk.vue'
import Biodata from '../Pages/Biodata.vue'

const routes = [
  { path: '/', component: Home },
  { path: '/produk', component: Produk },
  { path: '/biodata', component: Biodata },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
