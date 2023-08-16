import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'
import router from "./router";
import Api from "./api/index";
import store from "./store";
import VueMask from "v-mask";

import "./filters";

import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
import Swal from "./mixins/swal";
window.Swal = Swal;
Vue.use(VueMask);
Vue.use(VueSweetalert2);
Api.init();

Vue.config.productionTip = false

new Vue({
  vuetify,
  router,
  store,
  render: h => h(App)
}).$mount('#app')
