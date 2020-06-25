import MessageBus from './../../messageBus';
import router from '../../router/index';


export const UsersStore = {
    namespaced: true,
    state: 
    {
        users: [],
        status: '',
    },
    mutations: 
    {
        setUsers(state, users) 
        {
            state.users = users;
        },

        // onderstaande refactoren?

        // user remove state
        usersFetchRequest: (state) => {
            state.status = 'fetching';
        },
        usersFetchSuccess: (state) => {
            state.status = 'success';
        },
        usersFetchError: (state) => {
            state.status = 'error';
        },

       
        // user remove state
        userRemoveRequest: (state) => {
            state.status = 'removing';
        },
        userRemoveSuccess: (state) => {
            state.status = 'success';
        },
        useRemoveError: (state) => {
            state.status = 'error';
        },

        // registration state
        registerRequest: (state) => {
            state.status = 'registering';
        },
        registerSuccess: (state) => {
            state.status = 'success';
        },
        registerError: (state) => {
            state.status = 'error';
        },

        // registration activation state
        sendActivateRegistrationRequest: (state) => {
            state.status = 'registering';
        },
        sendActivateRegistrationSuccess: (state) => {
            state.status = 'success';
        },
        sendActivateRegistrationError: (state) => {
            state.status = 'error';
        },

        // user update state
        userUpdateRequest: (state) => {
            state.status = 'updating';
        },
        userUpdateSuccess: (state) => {
            state.status = 'success';
        },
        userUpdateError: (state) => {
            state.status = 'error';
        },
    },
    actions: 
    {
        fetchUsers({commit}) 
        {
            let url = `/api/admin/users`;
            commit('usersFetchRequest');

            return axios({
                method: 'get',
                url: url,
            }).then(response => {
                commit('usersFetchSuccess');
                commit('setUsers', response.data.data);
            }).catch(function (errors) {
                commit('usersFetchError');
                return Promise.reject(errors);
            });
        },
        deleteUser({commit}, userId) 
        {
            let url = `/api/admin/users/${userId}`;
            commit('userRemoveRequest');

            return axios({
                method: 'delete',
                url: url,
            }).then(messages => {
                commit('userRemoveSuccess');
                MessageBus.$emit('message', {message: 'User deleted', variant: 'success'});
            }).catch(function (error) {
                commit('userRemoveError');
                return Promise.reject(error);
            });
        },
        deleteUsers({ dispatch }, userIds) {
            // refactoren
            return new Promise((resolve, reject) => {
                let promises = [];

                userIds.forEach(userId => {
                    promises.push(dispatch('deleteUser' , userId));
                });

                Promise.all(promises).then((values) => {
                    resolve();
                }).catch(function (error) {
                    return Promise.reject(error);
                });
            });
        },
        // register a new user
        register: function({commit}, user) {
            commit('ErrorsStore/resetErrors', null, { root: true });
            commit('registerRequest');

            return axios({ url: '/api/users', data: user, method: 'POST' }).then(resp => 
            {
                commit('registerSuccess');
            })
            .catch(errors => 
            {
                commit('registerError');
                return Promise.reject(error);
            });
        },
        activateRegistration: function({commit}, activationToken) {
            commit('ErrorsStore/resetErrors', null, { root: true });
            commit('sendActivateRegistrationRequest');

            return axios({ url: '/api/user_registrations', data: { activationToken }, method: 'PUT' }).then(resp => 
            {
                commit('ErrorsStore/resetErrors', null, { root: true });
                commit('sendActivateRegistrationSuccess');
            })
            .catch(errors => 
            {                    
                commit('sendActivateRegistrationError');
                return Promise.reject(errors);
            });
        },      
        updateUser: function({commit}, user) {
            commit('ErrorsStore/resetErrors', null, { root: true });
            commit('userUpdateRequest');

            return axios({ 
                url: '/api/admin/users/' + user.id, 
                data: user,
                method: 'PATCH'}).then((resp) => {
                    commit('userUpdateSuccess', user);

                    setTimeout(() => {
                        // display success message after route change completes
                        MessageBus.$emit('message',
                            { message: 'Profiel succesvol bijgewerkt', variant: 'success' }
                        );
                    });
                })
                .catch((error) => {
                    commit('userUpdateError');
                    return Promise.reject(error);
                });
        },
    },
    getters: 
    {
        getUserById: (state) => (userId) => {
            return state.users.find(item => item.id == userId);
        },
    },
}