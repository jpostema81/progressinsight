import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../store/store';  

Vue.use(VueRouter);

const publicRoutes = require('../router/routes/public').default;
const privateRoutes = require('../router/routes/private').default;
const dashboardRoutes = require('../router/routes/dasboardroutes').default;


const router = new VueRouter({
	routes: [
        {   
            path: '/',
            redirect: { name: 'learning_goals' },
            component: Vue.component('Layout', require( '../layouts/Layout.vue').default),
            children: publicRoutes.concat(privateRoutes),
        },
        {   
            path: '/dashboard/',
            component: Vue.component('Dashboard', require( '../layouts/DashboardLayout.vue').default),
            children: dashboardRoutes,
        },
    ],
    scrollBehavior: function(to, from, savedPosition) 
    {    
        if(to.hash) 
        {
            // Use for direct jump.
            window.location.href = to.hash;
            // Use VueScrollTo for animation.
            //VueScrollTo.scrollTo(to.hash, 700);
            return { selector: to.hash }
        } 
        else if(savedPosition) 
        {
            return savedPosition;
        } 
        else 
        {
            return { x: 0, y: 0 }
        }
    },
});


router.beforeEach((to, from, next) => 
{
    // redirect to login page if not logged in and trying to access a restricted page
    const authorize = to.meta.authorize || [];
    const authenticationRequired = !to.matched.some(record => record.meta.public);
    const loggedIn = store.getters['AuthenticationStore/isAuthenticated'];
    const user = store.getters['AuthenticationStore/user'];
  
    if(authenticationRequired) 
    {
        if(!loggedIn)
        {
            // not logged in so redirect to login page
            console.log('Vue router: you are not authenticated to access this page!');
            return next('/login');
        }

        // check if route is restricted by role
        const intersection = authorize.filter(element => user.roles.includes(element));

        if (authorize.length && !intersection.length) {
            // role not authorised so redirect to home page
            console.log('Vue router: you are not authorized to access this page!');
            return next({ path: '/login' });
        }

        next();
    } 
    else 
    {
        next();
    }
});


export default router;