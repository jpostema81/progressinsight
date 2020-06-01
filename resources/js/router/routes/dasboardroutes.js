import Vue from 'vue';

const routes = [
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
    {
        path: '/dashboard/invitations/overview',
        alias: '/invitations_overview',
        name: 'invitations_overview',
        component: Vue.component('InvitationsOverview', require( '../../pages/dashboard/Invitations/Overview.vue').default)
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