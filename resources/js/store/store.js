import Vue from 'vue';
import Vuex from 'vuex';

// import VueX modules
import { LearningGoalsStore } from './modules/LearningGoalsStore';
import { AuthenticationStore } from './modules/AuthenticationStore';

Vue.use(Vuex);


export default new Vuex.Store({
    strict: process.env.NODE_ENV !== 'production',
    modules: {
        LearningGoalsStore,
        AuthenticationStore,
    },
});
