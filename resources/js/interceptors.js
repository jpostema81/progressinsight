import axios from 'axios';
import router from './router/index';
import MessageBus from './messageBus';
import store from './store/store';

axios.interceptors.request.use(config =>  
{
    /**
     * Here we will fecth the token from local storage and 
     * attach it (if exists) to the Authorization header on EVERY request.
     */
    let token = window.localStorage.getItem('user-token');

    if(token) 
    {
        config.headers['Authorization'] = 'Bearer ' + token;
    }

    return config;
}, 
function(error) 
{
    return Promise.reject(error);
});


axios.interceptors.response.use(function (response) {
    // Any status code that lie within the range of 2xx cause this function to trigger
    // do nothing, return response
    return response;
  }, function (error) {
    // Any status codes that falls outside the range of 2xx cause this function to trigger
    // Do something with response error

    store.commit('AuthenticationStore/authError', error);
                
    // if the request fails, remove any possible user token if possible
    localStorage.removeItem('user-token');
    
    switch(error.response.status) 
    {
         /**
         * If we get a 401 response from the API means that we are Unauthorized to
         * access the requested end point. 
         * This means that probably our token has expired and we need to get a new one.
         */
        case 401:
            MessageBus.$emit('message', {message: 'U bent niet bevoegd om deze pagina te bezoeken', variant: 'danger'});
            
            if(console.log(router.currentRoute.name !== 'login')) 
            {
                return router.go({name: 'login'});
            }

            Promise.reject(error);
            break;
            
            // return Vue.http.get('/refresh-token').then((result) => {
            //     // Save the new token on local storage
            //     window.localStorage.setItem('user-token', result.data.token)

            //     // Resend the failed request whatever it was (GET, POST, PATCH) and return its resposne
            //     return Vue.http(request).then((response) => {
            //         return response;
            //     })
            // })
            // .catch(() => {
            //     /**
            //      * We weren't able to refresh the token so the best thing to do is 
            //      * logout the user (removing any user information from storage)
            //      * and redirecting to login page
            //      */
            //     return router.go({name: 'login'})
            // })
        // user tried to access unauthorized resource
        case 403:
            MessageBus.$emit('message', {message: 'U bent niet bevoegd om deze pagina te bezoeken', variant: 'danger'});
            return router.go({name: 'login'});
        default:
            Promise.reject(error); 
    } 
});