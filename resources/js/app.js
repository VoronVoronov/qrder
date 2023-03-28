import './bootstrap';
import { createApp } from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import router from './router';
import App from './pages/Layouts/App.vue';
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import 'element-plus/theme-chalk/dark/css-vars.css'
import { createI18n } from 'vue-i18n'
import { vMaska } from "maska"
import RU from './locales/RU'
import EN from './locales/EN'
import KZ from './locales/KZ'
import store from './store.js';
const i18n = createI18n({
    locale: 'ru',
    fallbackLocale: 'ru',
    messages: {
        ru: RU,
        en: EN,
        kz: KZ
    }
})

const app = createApp(App);
app.use(ElementPlus)
app.use(VueAxios, axios);
app.use(router);
app.use(i18n)
app.directive("maska", vMaska)
app.use(store)
app.mount('#app');
