// import './assets/main.css'

//in main.js
import 'primevue/resources/themes/aura-light-green/theme.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import PrimeVue from 'primevue/config'
import App from './App.vue'
import router from './router/index'
import Message from 'primevue/message'
import Button from 'primevue/button'
import Toast from 'primevue/toast'
import ToastService from 'primevue/toastservice'
import Dialog from 'primevue/dialog'
import ConfirmDialog from 'primevue/confirmdialog'
import ConfirmationService from 'primevue/confirmationservice'

const app = createApp(App)

app.use(createPinia())
app.use(PrimeVue)
app.use(router)
app.component('Message', Message)
app.component('Button', Button)
app.component('Toast', Toast)
app.component('Dialog', Dialog)
app.component('ConfirmDialog', ConfirmDialog)
app.use(ToastService)
app.use(ConfirmationService)

app.mount('#app')
