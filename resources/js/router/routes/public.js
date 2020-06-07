import Vue from 'vue';

const NotFound = { template: "<div>not found</div>" };

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
        component: Vue.component('Register', require( '../../pages/Register.vue').default),
    },
    {
        path: '/invitations/:activationToken/activate',
        alias: '/activate_invitation',
        name: 'activate_invitation',
        component: Vue.component('AcitvateInvitation', require( '../../pages/Invitations/AcitvateInvitation.vue').default)
    },
    {   path: "*", 
        component: NotFound ,
    }
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