require('./bootstrap');
require('./interceptors');

import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';
import store from './store/store';
import router from './router/index';
import Multiselect from 'vue-multiselect';
import MessageBus from './messageBus';
import App from './App.vue';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import VueSidebarMenu from 'vue-sidebar-menu';
import 'vue-sidebar-menu/dist/vue-sidebar-menu.css';


window.moment = require('moment');


// wait until DOM is loaded before loading vue root element
window.onload = function() {
  Vue.use(BootstrapVue);
  Vue.use(moment);
  Vue.component('Multiselect', Multiselect);
  Vue.use(VueSidebarMenu);

  const app = new Vue({
    store,
    router,
    created() {
      // check if there is a token in localStorage
      if (localStorage.getItem('user-token')) {
        // token found, try to get user by token
        this.$store.dispatch('AuthenticationStore/authenticateByToken')
            .then((data) => {
                this.$store.dispatch('LearningGoalsStore/fetchProgressLevels').then(() => {
                    this.$store.dispatch('LearningGoalsStore/fetchTopics').then(() => {
                        this.$store.dispatch('LearningGoalsStore/fetchLearningGoals').then(() => {
                            this.$router.push('/learning_goals');
                        });
                    });
                });
            }).catch((error) => {
                // token is invalid, delete token from localStorage so it doesn't
                // get attached to the request headers by
                // the axios interceptor
                localStorage.removeItem('user-token');
            });
      }
    },
    render: (h) => h(App),
  }).$mount('#app');

  MessageBus.$app = app;
};
