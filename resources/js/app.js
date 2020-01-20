require('./bootstrap');
require('./interceptors');

import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';
import store from './store/store';
import router from './router/index';
import Multiselect from 'vue-multiselect';
import MessageBus from './messageBus';
import App from './App.vue'
import 'bootstrap-vue/dist/bootstrap-vue.css';


// wait until DOM is loaded before loading vue root element
window.onload = function () 
{
    Vue.use(BootstrapVue);
    Vue.component('Multiselect', Multiselect);

    const app = new Vue({
        store,
        router,
        created() 
        {
            // check if there is a token in localStorage
            // if(localStorage.getItem('user-token'))
            // {
            //     // token found, try to get user by token
            //     this.$store.dispatch('AuthenticationStore/authenticateByToken').then(data => {}).catch(error => 
            //     {
            //         // token is invalid, delete token from localStorage so it doesn't get attached to the request headers by 
            //         // the axios interceptor
            //         localStorage.removeItem('user-token');
            //     });
            // }
        },
        render: h => h(App)
    }).$mount('#app')

    MessageBus.$app = app;
}