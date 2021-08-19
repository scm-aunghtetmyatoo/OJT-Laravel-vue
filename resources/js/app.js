require('./bootstrap');
import vue from 'vue'
window.Vue = vue;


import App from './components/App.vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';

// import 'es6-promise/auto'
// import * as VueAuth from '@websanova/vue-auth';
// import * as VueAuth from '@websanova/vue-auth/dist/v2/vue-auth.esm.js';


import auth from './auth'

 
Vue.use(VueRouter);
Vue.use(VueAxios, axios);


// axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`;
// Vue.use(VueAuth, auth);
// Vue.use(VueAuth, {
//     auth: require('@websanova/vue-auth/dist/drivers/auth/bearer.js'),
//     http: require('@websanova/vue-auth/dist/drivers/http/axios.1.x.js'),
//     router: require('@websanova/vue-auth/dist/drivers/router/vue-router.2.x.js'),
//     rolesVar: 'role'
//   });
 
const router = new VueRouter({
    mode: 'history',
    routes: routes
});

 
const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});