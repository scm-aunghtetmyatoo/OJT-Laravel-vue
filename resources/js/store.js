import Vue from "vue";
import Vuex from "vuex";
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex);

export default new Vuex.Store({
  plugins: [createPersistedState({
    storage: window.sessionStorage,
  })],
  
  state: {
    auth: {
      login: false,
      user: [],
    },
  },

  getters: {
    isLoggedIn(state) {
      return state.auth.login;
    },
  },

  mutations: {
    LOGIN(state, status) {
      state.auth.login = status;
      state.auth.user = [];
    },

    AUTH_USER(state, user) {
      state.auth.user = user;
    },
  },

  actions: {},
});
