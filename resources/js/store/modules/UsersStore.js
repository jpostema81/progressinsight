import MessageBus from './../../messageBus';


export const UsersStore = {
    namespaced: true,
    state: 
    {
        users: [],
        errors: {},
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
                    // authorization error
                    // move to interceptor?
                    if(errors.response.status === 403)
                    {
                        MessageBus.$emit('message', {message: 'There was an authorization error', variant: 'danger'}); 
                    } else 
                    {
                        MessageBus.$emit('message', {message: 'There was an error while fetching users', variant: 'danger'}); 
                    }
                    

                    commit('setErrors', errors);
                    reject(errors);
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
    }
}