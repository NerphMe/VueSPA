require('./bootstrap');

import { createApp } from 'vue';
import router from './core/router';
import App from './App.vue';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import 'bootstrap/dist/js/bootstrap.bundle.min';
import Toast from 'vue-toastification';
import 'vue-toastification/dist/index.css';


const app = createApp(App);
app.use(router);
app.use(Toast);

app.mount('#app');
