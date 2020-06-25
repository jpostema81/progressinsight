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
        fetchLearningGoals({commit, rootState}) 
        {
            let url = `/api/users/${rootState.AuthenticationStore.user.id}/learning_goals`;

            return axios({
                method: 'get',
                url: url,
            }).then(response => {
                commit('setLearningGoals', response.data.data);
            }).catch(function (errors) {
                return Promise.reject(errors);
            });
        },
        fetchTopics({commit}) 
        {
            let url = '/api/topics';

            return axios({
                method: 'get',
                url: url,
            }).then(response => {
                commit('setTopics', response.data.data);
            }).catch(function (errors) {
                return Promise.reject(errors);
            });
        },
        fetchProgressLevels({commit}) 
        {
            let url = '/api/progress_levels';

            return axios({
                method: 'get',
                url: url,
            }).then(response => {
                commit('setProgressLevels', response.data.data);
            }).catch(function (errors) {
                Promise.reject(errors);
            });
        },
        updateUserLearningGoal({ commit, rootState }, { progressLevelId, learningGoalId }) 
        {
            let url = `/api/users/${rootState.AuthenticationStore.user.id}/learning_goals/${learningGoalId}`;

            return axios({
                method: 'put',
                url: url,
                params: { progressLevelId },
            }).then(response => {
                commit('updateUserLearningGoal', response.data.learningGoal);
            }).catch(function (errors) {
                return Promise.reject(errors);
            });
        },
    },
    getters: 
    {
        learningGoals: (state) => {
            return state.learningGoals;
        },
        progressLevels: (state) => {
            return state.progressLevels;
        },
        getProgressPercentageByProgressLevelId: (state) => {
            return (progressId) => {
                return state.progressLevels.find(element => element.id == progressId).percentage;
            }
        },
        topics: (state) => {
            return state.topics;
        },
        // tells whether all required data is loaded into the store state
        isBusy: () => {
            return learningGoals.length && progressLevels.length && topics.length;
        }
    }
}