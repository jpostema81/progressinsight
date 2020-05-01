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
        updateUserLearningGoal(state, userLearningGoal) {
            let learningGoal = state.learningGoals.find(element => element.id === userLearningGoal.id);
            learningGoal.progress_level = userLearningGoal.progress_level;
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
                    MessageBus.$emit('message', {message: 'There was an error while fetching learninggoals', variant: 'danger'}); 

                    commit('setErrors', errors);
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
                    MessageBus.$emit('message', {message: 'There was an error while fetching topics', variant: 'danger'}); 

                    commit('setErrors', errors);
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
                    MessageBus.$emit('message', {message: 'There was an error while fetching progresslevels', variant: 'danger'}); 

                    commit('setErrors', errors);
                    reject(errors);
                });
            });   
        },
        updateUserLearningGoal({ commit, state, rootState, rootGetters }, { progressLevelId, learningGoalId }) 
        {
            return new Promise((resolve, reject) => {
                let url = `/api/users/${rootState.AuthenticationStore.user.id}/learning_goals/${learningGoalId}`;

                axios({
                    method: 'put',
                    url: url,
                    params: { progressLevelId },
                }).then(response => {
                    commit('updateUserLearningGoal', response.data.learningGoal);
                    resolve();
                }).catch(function (errors) {
                    MessageBus.$emit('message', {message: 'There was an error while updating user learninggoal', variant: 'danger'}); 

                    commit('setErrors', errors);
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
        hundredPercentProgressLevel: (state) => {
            return state.progressLevels.find((progressLevel) => { return progressLevel.percentage == 100; });
        },
        // tells whether all required data is loaded into the store state
        isBusy: (state) => {
            return learningGoals.length && progressLevels.length && topics.length;
        }
    }
}