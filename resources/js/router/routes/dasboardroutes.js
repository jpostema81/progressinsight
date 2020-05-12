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
        path: '/dashboard/users/create',
        alias: '/users_create',
        name: 'users_create',
        component: Vue.component('UsersCreate', require( '../../pages/dashboard/Users/Create.vue').default)
    },
    // {
    //     path: '/dashboard/blogposts',
    //     name: 'dashboardBlogpostsOverview',
    //     component: Vue.component('BlogpostsOverview', require( '../../pages/dashboard/BlogpostsOverview.vue').default)
    // },
    // {
    //     path: '/dashboard/blogposts/:blogPostId/edit',
    //     name: 'blogpostEdit',
    //     component: Vue.component('blogpostNewEdit', require( '../../pages/dashboard/blogpostNewEdit.vue').default)
    // },
    // {
    //     path: '/dashboard/blogposts/create',
    //     name: 'blogpostNew',
    //     component: Vue.component('blogpostNewEdit', require( '../../pages/dashboard/blogpostNewEdit.vue').default)
    // },
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