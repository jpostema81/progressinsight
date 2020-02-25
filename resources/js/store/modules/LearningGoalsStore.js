import MessageBus from './../../messageBus';

export const LearningGoalsStore = {
    namespaced: true,
    state: 
    {
        learningGoals: [],
        progressLevels: [],
        topics: [],
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
        setTopics(state, topics) 
        {
            state.topics = topics;
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

                axios({
                    method: 'get',
                    url: url,
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
        fetchTopics({commit, state, rootState, rootGetters}) 
        {
            return new Promise((resolve, reject) => {
                let url = '/api/topics';

                axios({
                    method: 'get',
                    url: url,
                }).then(response => {
                    commit('setTopics', response.data.data);
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
                    MessageBus.$emit('message', { message: 'Uw voortgang is opgeslagen', variant: 'success' }); 
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
        progressLevels: (state) => {
            return state.progressLevels;
        },
        topics: (state) => {
            return state.topics;
        },
        // return function from this getter which can be used to passed data in
        getLearningGoalsByTopic: (state) => {
            return (topic) => state.learningGoals.filter((learningGoal) => { return learningGoal.topic.id === topic.id });
        },
        getCompletedLearningGoals: (state, getters) => {
            // count users LearningGoals which have a ProgressLevel of 100%
            if(state.learningGoals) {
                return state.learningGoals.filter((learningGoal) => learningGoal.progress_level.id === getters.hundredPercentProgressLevel.id);
            }
            
        },
        getCompletedLearningGoalsByTopic: (state, getters) => {
            // count users LearningGoals by topic which have a ProgressLevel of 100%
            if(state.learningGoals) {
                return (topic) => {
                    return getters.getLearningGoalsByTopic(topic).filter((learningGoal) => learningGoal.progress_level.id === getters.hundredPercentProgressLevel.id);
                }; 
            }              
        },
        hundredPercentProgressLevel: (state) => {
            return state.progressLevels.find((progressLevel) => { return progressLevel.percentage == 100; })
        }
    }
}