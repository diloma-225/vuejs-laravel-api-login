import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import Modal from './components/modal-component.vue'

const app = createApp(App);
app.component('modal-component', Modal)
app.use(router).mount("#app");
