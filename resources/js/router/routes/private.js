import Vue from 'vue';

const routes = [
    {
        path: '/learning_goals',
        alias: '/',
        name: 'learning_goals',
        component: Vue.component('LearningGoals', require( '../../pages/LearningGoals.vue').default)
    },
    {
        path: '/dashboard/profile',
        name: 'profile',
        component: Vue.component('Profile', require( '../../pages/Profile.vue').default)
    },
    {
        path: '/progress_stats',
        name: 'progress_stats',
        component: Vue.component('ProgressStats', require( '../../pages/ProgressStats.vue').default)
    },
];

export default routes.map(route => 
{
    const meta = 
    {
        public: false,
    }

    return { ...route, meta }
});