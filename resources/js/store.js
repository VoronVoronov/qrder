import { createStore } from 'vuex';

const store = createStore({
    state() {
        return {
            authenticated: false
        };
    },
    mutations: {
        setAuthenticated(state, value) {
            state.authenticated = value;
        }
    },
    getters: {
        authenticated(state) {
            return state.authenticated;
        }
    }
});

export default store;
