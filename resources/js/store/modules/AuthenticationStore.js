import router from '../../router/index';
import MessageBus from './../../messageBus';

export const AuthenticationStore = 
{
    namespaced: true,
    state: {
        status: '',
        user: '',
    },
    mutations: {
        // authentication state
        authRequest: (state) => {
            state.status = 'loading';
        },
        authSuccess: (state, user) => {
            state.status = 'success';
            state.user = user;
        },
        authError: (state) => {
            state.status = 'error';
        },

        logout: (state) => {
            state.status = '';
            state.user = '';
        },
    },
    actions:
    {
        // authenticate by JWT token (token from login or local storage)
        authenticateByToken: ({commit, dispatch}) => 
        {
            commit('ErrorsStore/resetErrors', null, { root: true });
            commit('authRequest');

            return new Promise((resolve, reject) => 
            {
                axios({ url: '/api/get_user_by_token', method: 'POST' }).then(resp => 
                {
                    const user = resp.data;
                    commit('authSuccess', user);
                    resolve(resp);
                })
                .catch(errors => 
                {
                    commit('authError');
                    dispatch('logout');
                    reject(errors);
                });
            });
        },
        // authenticate by user login (email & password)
        login: ({commit}, user) => 
        {
            return new Promise((resolve, reject) => 
            { 
                commit('ErrorsStore/resetErrors', null, { root: true });
                commit('authRequest');

                axios({ url: '/api/login', data: user, method: 'POST' }).then(resp => 
                {
                    const token = resp.data.access_token;
                    const user = resp.data.user;

                    // store the token in localstorage
                    localStorage.setItem('user-token', token);
                    // token received, set user
                    commit('authSuccess', user);
                    MessageBus.$emit('message', {message: 'U bent ingelogd ' + user.full_name, variant: 'success'});
                    resolve(resp);
                })
                .catch(error => {
                    commit('authError');
                    reject(error);
                });
            });
        },
        logout: function({commit}) {
            // no serverside logout to keep tokens stateless.
            // Just remove tokens from client
            localStorage.removeItem('user-token');
            commit('logout');
            MessageBus.$emit('message', { message: 'U bent nu uitgelogd', variant: 'success' });
            router.push('/login');
        },
    },
    getters:
    {
        isAuthenticated: (state) => {
            return !!state.user;
        },
        isAdmin: (state) => {
            return !!state.user && state.user.roles.map(role => role.name).includes('admin');
        },
        user: (state) => {
            return state.user;
        },
        status: (state) => {
            return state.status;
        },
    },
};
