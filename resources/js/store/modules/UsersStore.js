import MessageBus from './../../messageBus';


export const UsersStore = {
    namespaced: true,
    state: 
    {
        users: [],
        errors: {},
        status: '',
    },
    mutations: 
    {
        setUsers(state, users) 
        {
            state.users = users;
        },
        setErrors: (state, errors) => {
            state.errors = errors;
        },

        // removeUser mutations
        removeUser: (state, userId)  =>
        {
            state.users = state.users.filter(item => item.id != userId)
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
                    commit('setErrors', errors);
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
                    commit('setErrors', error);
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

        
        // updateUser({ commit, state, rootState, rootGetters }, { progressLevelId, learningGoalId }) 
        // {
        //     return new Promise((resolve, reject) => {
        //         let url = `/api/users/${rootState.AuthenticationStore.user.id}/learning_goals/${learningGoalId}`;

        //         axios({
        //             method: 'put',
        //             url: url,
        //             params: { progressLevelId },
        //         }).then(response => {
        //             commit('updateUserLearningGoal', response.data.learningGoal);
        //             resolve();
        //         }).catch(function (errors) {
        //             MessageBus.$emit('message', {message: 'There was an error while updating user learninggoal', variant: 'danger'}); 

        //             commit('setErrors', errors);
        //             reject(errors);
        //         });
        //     });   
        // },
    },
    getters: 
    {
        // users: (state, commit, rootState) => {
        //     return state.users;
        // },
        getUserById: (state) => (userId) => {
            return state.users.filter(item => item.id != userId)
        },
    }
}