/*!

 =========================================================
 * Vue Now UI Kit - v1.1.0
 =========================================================

 * Product Page: https://www.creative-tim.com/product/now-ui-kit
 * Copyright 2019 Creative Tim (http://www.creative-tim.com)

 * Designed by www.invisionapp.com Coded by www.creative-tim.com

 =========================================================

 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

 */
import Vue from 'vue';
import App from './App.vue';

// import router and vue-router 
import VueRouter from 'vue-router'
import router from './router';

//import the template plugin
import NowUiKit from './plugins/now-ui-kit';
// Import VueScheduler
import VueScheduler from 'v-calendar-scheduler';
// Import VueScheduler styles
import 'v-calendar-scheduler/lib/main.css';

// Import axios
import axios from 'axios';
import VueAxios from 'vue-axios';
// Import Auth
import VueAuth from '@websanova/vue-auth'

Vue.config.productionTip = false;

export const Bus = new Vue();
Vue.use(NowUiKit);
Vue.use(VueScheduler,{ locale: 'fr'});
Vue.use(VueRouter);
Vue.use(VueAxios, axios);

//vue router must be called before the auth to be setted
Vue.router = router
//confg the  Auth 
Vue.use(VueAuth, {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js')
});

new Vue({
  router,
  render: h => h(App)
}).$mount('#app');

