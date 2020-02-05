import MessageBus from './../../messageBus';

export const LearningGoalsStore = {
    namespaced: true,
    state: 
    {
        learningGoals: [],
        progressLevels: [],
        errors: {},
    },
    mutations: 
    {
        setLearningGoals(state, learningGoals) 
        {
            state.learningGoals = learningGoals;
        },
        setProgressLevels(state, progressLevels) 
        {
            state.progressLevels = progressLevels;
        },
        setErrors: (state, errors) => {
          state.errors = errors;
        },
    },
    actions: 
    {
        fetchLearningGoals({commit, state, rootState, rootGetters}) 
        {
            return new Promise((resolve, reject) => {
                let url = `/api/users/${rootState.AuthenticationStore.user.id}/learning_goals`;
                let data = { user_id: 1 };

                axios({
                    method: 'get',
                    url: url,
                    params: data,
                }).then(response => {
                    commit('setLearningGoals', response.data.data);
                    resolve();
                }).catch(function (errors) {
                    Object.values(errors.response.data.errors).forEach(error => {
                        MessageBus.$emit('message', {message: error, variant: 'danger'}); 
                    });

                    commit('setErrors', errors.response.data.errors);
                    reject(errors);
                });
            });   
        },
        fetchProgressLevels({commit, state, rootState, rootGetters}) 
        {
            return new Promise((resolve, reject) => {
                let url = '/api/progress_levels';

                axios({
                    method: 'get',
                    url: url,
                }).then(response => {
                    commit('setProgressLevels', response.data.data);
                    resolve();
                }).catch(function (errors) {
                    Object.values(errors.response.data.errors).forEach(error => {
                        MessageBus.$emit('message', {message: error, variant: 'danger'}); 
                    });

                    commit('setErrors', errors.response.data.errors);
                    reject(errors);
                });
            });   
        },
        updateLearningGoals({commit, state, rootState, rootGetters}, learningGoals) 
        {
            return new Promise((resolve, reject) => {
                let url = `/api/users/${rootState.AuthenticationStore.user.id}/learning_goals`;

                axios({
                    method: 'post',
                    url: url,
                    data: { learningGoals },
                }).then(response => {
                    MessageBus.$emit('message', { message: 'Your settings have been saved', variant: 'success' }); 
                    resolve();
                }).catch(function (errors) {
                    Object.values(errors.response.data.errors).forEach(error => {
                        MessageBus.$emit('message', {message: error, variant: 'danger'}); 
                    });

                    commit('setErrors', errors.response.data.errors);
                    reject(errors);
                });
            });   
        },
    },
    getters: 
    {
        learningGoals: (state, commit, rootState) => {
            return state.learningGoals;
        },
        progressLevels: (state, commit, rootState) => {
          return state.progressLevels;
        },
    }
}