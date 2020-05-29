import Vue from 'vue';
import Vuex from 'vuex';

// import VueX modules
import { LearningGoalsStore } from './modules/LearningGoalsStore';
import { AuthenticationStore } from './modules/AuthenticationStore';
import { UsersStore } from './modules/UsersStore';
import { ErrorsStore } from './modules/ErrorsStore';
import { RolesStore } from './modules/RolesStore';
import { InvitesStore } from './modules/InvitesStore';


Vue.use(Vuex);

export default new Vuex.Store({
    strict: process.env.NODE_ENV !== 'production',
    modules: {
        LearningGoalsStore,
        AuthenticationStore,
        UsersStore,
        ErrorsStore,
        RolesStore,
        InvitesStore,
    },
});
