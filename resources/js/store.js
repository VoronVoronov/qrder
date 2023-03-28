import { createStore } from 'vuex';
import config from "./config";

const store = createStore({
    state() {
        return {
            authenticated: false,
            showLayout: false,
            locale: null,
        };
    },
    mutations: {
        setAuthenticated(state, value) {
            state.authenticated = value;
        },
        setShowLayout(state, value) {
            state.showLayout = value;
        },
        setLocale(state, value) {
            state.locale = value;
        }
    },
    getters: {
        authenticated(state) {
            return state.authenticated;
        },
        showLayout(state) {
            return state.showLayout;
        },
        locale(state) {
            return state.locale;
        }
    }
});

store.watch(
    (state) => state.locale,
    (locale) => {
        config.API_URL = '/api/'+ locale + '/v1/';
    }
)

export default store;
