import Vue from 'vue';

const routes = [
    {
      path: '/learning_goals',
      alias: '/',
      name: 'learning_goals',
      component: Vue.component('LearningGoals', require( '../../pages/LearningGoals.vue').default)
    },
    // {
    //     path: '/blogposts/:blogPostId',
    //     name: 'blogpostsOverview',
    //     component: Vue.component('BlogPost', require( '../../pages/BlogPost.vue').default)
    // },
    {
        path: '/login',
        name: 'login',
        component: Vue.component('Login', require( '../../pages/Login.vue').default)
    },
    // {
    //     path: '/register',
    //     name: 'register',
    //     component: Vue.component('Register', require( '../../pages/Register.vue').default)
    // },
];

export default routes.map(route => 
{
    const meta = 
    {
        public: true,
    }

    return { ...route, meta }
});