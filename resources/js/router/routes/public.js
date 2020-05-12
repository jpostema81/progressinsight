import Vue from 'vue';

const routes = [
    {
        path: '/login',
        name: 'login',
        component: Vue.component('Login', require( '../../pages/Login.vue').default),
    },
    {
        path: '/register',
        name: 'register',
        component: Vue.component('Register', require( '../../pages/Register.vue').default),
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