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
       
        // removeUser mutations
        removeUser: (state, userId)  =>
        {
            state.users = state.users.filter(item => item.id != userId)
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

        // user update state
        userUpdateRequest: (state) => {
            state.status = 'updating';
        },
        userUpdateSuccess: (state, user) => {
            state.status = 'success';
        },
        userUpdateError: (state, errors) => {
            state.status = 'error';
        },
    },
    actions: 
    {
        fetchUsers({commit, state, rootState, rootGetters}) 
        {
            return new Promise((resolve, reject) => {
                let url = `/api/admin/users`;

                axios({
                    method: 'get',
                    url: url,
                }).then(response => {
                    commit('setUsers', response.data.data);
                    resolve();
                }).catch(function (errors) {
                    MessageBus.$emit('message', {message: 'There was an error while fetching users', variant: 'danger'}); 
                    commit('ErrorsStore/setErrors', errors, { root: true });
                    reject(errors);
                });
            });   
        },
        deleteUser({commit, state, rootState, rootGetters}, userId) 
        {
            return new Promise((resolve, reject) => {
                let url = `/api/admin/users/${userId}`;

                axios({
                    method: 'delete',
                    url: url,
                }).then(messages => {
                    commit('removeUser', userId);
                    MessageBus.$emit('message', {message: 'User deleted', variant: 'success'});
                    resolve();
                }).catch(function (error) {
                    MessageBus.$emit('message', {message: 'Something went wrong', variant: 'danger'});
                    commit('ErrorsStore/setErrors', error, { root: true });
                    reject(error);
                });
            });   
        },
        deleteUsers({ dispatch, commit, state, rootState, rootGetters }, userIds) {
            return new Promise((resolve, reject) => {
                let promises = [];

                userIds.forEach(userId => {
                    promises.push(dispatch('deleteUser' , userId));
                });

                Promise.all(promises).then((values) => {
                    resolve();
                }).catch(function (error) {
                    reject(error);
                });
            });
        },
        // register a new user
        register: function({commit, dispatch, context}, user) {
            commit('ErrorsStore/resetErrors', null, { root: true });
            commit('registerRequest');

            return new Promise((resolve, reject) => { 
                axios({ url: '/api/register', data: user, method: 'POST' }).then(resp => 
                {
                    commit('ErrorsStore/resetErrors', null, { root: true });
                    commit('registerSuccess');

                    resolve(resp);
                })
                .catch(errors => 
                {
                    Object.values(errors.response.data.errors).forEach(error => {
                        MessageBus.$emit('message', { message: error, variant: 'danger' }); 
                    });
                    
                    commit('ErrorsStore/setErrors', errors.response.data.errors, { root: true });
                    commit('registerError');
                    reject(errors);
                });
            });
        },
        updateUser: function({commit, dispatch, context}, user) {
            commit('ErrorsStore/resetErrors', null, { root: true });
            commit('userUpdateRequest');

            return new Promise((resolve, reject) => {
                axios({ 
                    url: '/api/users/' + user.id, 
                    data: user,
                    method: 'PATCH'}).then((resp) => {
                        commit('ErrorsStore/resetErrors', null, { root: true });
                        commit('userUpdateSuccess', user);

                        setTimeout(() => {
                            // display success message after route change completes
                            MessageBus.$emit('message',
                                { message: 'Profiel succesvol bijgewerkt', variant: 'success' }
                            );
                        });

                        resolve(resp);
                    })
                    .catch((error) => {
                        MessageBus.$emit('message',
                        {
                            message: 'Er ging iets fout tijdens het bijwerken van uw profielgegevens',
                            variant: 'danger',
                        });

                        commit('ErrorsStore/resetErrors', error, { root: true });
                        commit('userUpdateError', error.response.data.errors);
                        reject(error);
                    });
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