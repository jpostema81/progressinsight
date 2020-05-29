import Vue from 'vue';

const routes = [
    // {
    //     path: '/dashboard',
    //     name: 'dashboard',
    //     component: Vue.component('Dashboard', require( '../../pages/dashboard/Dashboard.vue').default)
    // },
    {
        path: '/dashboard/users/overview',
        alias: '/users_overview',
        name: 'users_overview',
        component: Vue.component('UsersOverview', require( '../../pages/dashboard/Users/Overview.vue').default)
    },
    {
        path: '/dashboard/users/invite',
        alias: '/users_invite',
        name: 'users_invite',
        component: Vue.component('UsersInvite', require( '../../pages/dashboard/Users/Invite.vue').default)
    },
    {
        path: '/dashboard/users/:blogPostId/edit',
        alias: '/users_edit',
        name: 'users_edit',
        component: Vue.component('UsersCreate', require( '../../pages/dashboard/Users/Edit.vue').default)
    },
];

export default routes.map(route => 
{
    const meta = 
    {
        public: false,
        authorize: ['admin'],
    }

    return { ...route, meta }
});