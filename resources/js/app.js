import { createApp } from 'vue'
import App from './Layouts/App.vue' // atau file root Vue kamu
import router from './router'

createApp(App).use(router).mount('#app')
