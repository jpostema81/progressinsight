import Vue from 'vue';

const routes = [
    // {
    //     path: '/dashboard',
    //     name: 'dashboard',
    //     component: Vue.component('Dashboard', require( '../../pages/dashboard/Dashboard.vue').default)
    // },
    {
        path: '/dashboard/users_overview',
        alias: '/',
        name: 'users_overview',
        component: Vue.component('UsersOverview', require( '../../pages/dashboard/UsersOverview.vue').default)
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
    }

    return { ...route, meta }
});