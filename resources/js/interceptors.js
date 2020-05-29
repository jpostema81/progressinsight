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
        config.headers['Authorization'] = `Bearer ${token}`;
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
    if (!error.response) 
    {
        return Promise.reject(error);
    }
    // Any status codes that falls outside the range of 2xx cause this function to trigger
    // Do something with response error

    store.commit('ErrorsStore/setErrors', error);

    // refresh token reply should stay silent
    if(error.request.responseURL.indexOf('get_user_by_token') > -1)
    {
        return Promise.reject(error);
    }

    MessageBus.$emit('message', { message: error.response.data.message, variant: 'danger' });
    
    switch(error.response.status) 
    {
         /**
         * If we get a 401 response from the API means that we are Unauthorized to
         * access the requested end point. 
         * This means that probably our token has expired and we need to get a new one.
         */
        case 401:
            if(router.currentRoute.name !== 'login') 
            {
                store.dispatch('AuthenticationStore/logout', false);
            }

            // break promise and return error
            return Promise.reject(error, false);
        // user tried to access unauthorized resource
        case 403:            
            store.dispatch('AuthenticationStore/logout', false);

            return Promise.reject(error);
        default:
            return Promise.reject(error);
    } 
});