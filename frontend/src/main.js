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

// import router
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


//import store
import Store from './store';

//import Vuex
import Vuex from 'vuex'

Vue.config.productionTip = false;

export const Bus = new Vue();
Vue.use(NowUiKit);
Vue.use(VueScheduler,{ locale: 'fr'});
Vue.use(VueAxios, axios);
Vue.use(Vuex);

const store = new Vuex.Store(Store);


new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app');

