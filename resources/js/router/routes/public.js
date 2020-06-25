import Vue from 'vue';

const routes = [
    {
        path: '/login',
        alias: '/',
        name: 'login',
        component: Vue.component('Login', require( '../../pages/Login.vue').default),
    },
    {
        path: '/register',
        name: 'register',
        component: Vue.component('Register', require( '../../pages/registration/Register.vue').default),
    },
    {
        path: '/register/:activationToken/activate',
        alias: '/activate_registration',
        name: 'activate_registration',
        component: Vue.component('AcitvateRegistration', require( '../../pages/registration/AcitvateRegistration.vue').default)
    },
    {
        path: '/invitations/:activationToken/activate',
        alias: '/activate_invitation',
        name: 'activate_invitation',
        component: Vue.component('AcitvateInvitation', require( '../../pages/Invitations/AcitvateInvitation.vue').default)
    },
];

export default routes.map(route => 
{
    const meta = 
    {
        public: true,
        authorize: [],
    }

    return { ...route, meta }
});