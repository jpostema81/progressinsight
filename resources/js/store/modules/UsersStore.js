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

            return axios({
                method: 'get',
                url: url,
            }).then(response => {
                commit('setUsers', response.data.data);
            }).catch(function (errors) {
                MessageBus.$emit('message', {message: 'There was an error while fetching users', variant: 'danger'}); 
                commit('ErrorsStore/setErrors', errors, { root: true });
            });
        },
        deleteUser({commit}, userId) 
        {
            let url = `/api/admin/users/${userId}`;

            return axios({
                method: 'delete',
                url: url,
            }).then(messages => {
                commit('removeUser', userId);
                MessageBus.$emit('message', {message: 'User deleted', variant: 'success'});
            }).catch(function (error) {
                MessageBus.$emit('message', {message: 'Something went wrong', variant: 'danger'});
                commit('ErrorsStore/setErrors', error, { root: true });
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
                    reject(error);
                });
            });
        },
        // register a new user
        register: function({commit}, user) {
            commit('ErrorsStore/resetErrors', null, { root: true });
            commit('registerRequest');

            return axios({ url: '/api/users', data: user, method: 'POST' }).then(resp => 
            {
                commit('ErrorsStore/resetErrors', null, { root: true });
                commit('registerSuccess');
            })
            .catch(errors => 
            {
                // kan er uit?
                Object.values(errors.response.data.errors).forEach(error => {
                    MessageBus.$emit('message', { message: error, variant: 'danger' }); 
                });
                
                commit('ErrorsStore/setErrors', errors.response.data.errors, { root: true });
                commit('registerError');
            });
        },
        updateUser: function({commit}, user) {
            commit('ErrorsStore/resetErrors', null, { root: true });
            commit('userUpdateRequest');

            return axios({ 
                url: '/api/admin/users/' + user.id, 
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
                })
                .catch((error) => {
                    // kan er uit?
                    MessageBus.$emit('message',
                    {
                        message: 'Er ging iets fout tijdens het bijwerken van uw profielgegevens',
                        variant: 'danger',
                    });

                    commit('ErrorsStore/resetErrors', error, { root: true });
                    commit('userUpdateError', error.response.data.errors);
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