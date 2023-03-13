import './bootstrap';
import { createApp } from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import router from './router';
import App from './components/Layouts/App.vue';
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import 'element-plus/theme-chalk/dark/css-vars.css'
import { createI18n } from 'vue-i18n'
import RU from './locales/RU'
import EN from './locales/EN'
import KZ from './locales/KZ'
const i18n = createI18n({
    locale: 'RU',
    fallbackLocale: 'RU',
    messages: {
        RU,
        EN,
        KZ
    }
})

const app = createApp(App);
app.use(ElementPlus)
app.use(VueAxios, axios);
app.use(router);
app.use(i18n)
app.mount('#app');
