// import './assets/main.css'

//in main.js
import 'primevue/resources/themes/aura-light-green/theme.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import PrimeVue from 'primevue/config';
import App from './App.vue'
import Message from 'primevue/message';
import Button from 'primevue/button';
import Toast from 'primevue/toast';
import ToastService from 'primevue/toastservice';


const app = createApp(App)

app.use(createPinia())
app.use(PrimeVue);
app.component('Message', Message);
app.component('Button', Button);
app.component('Toast', Toast);
app.use(ToastService);

app.mount('#app')
