import Vue from 'vue';
import Vuex from 'vuex';

// import VueX modules

// front-end
import { MessageStore } from './modules/MessageStore.js';
import { AuthenticationStore } from './modules/AuthenticationStore';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        MessageStore,
        AuthenticationStore,
    }
})