export const LearningGoalsStore = {
    namespaced: true,
    state: 
    {
        learningGoals: [],
        progressLevels: [],
        meta: [],
        // status: '',
        // errors: {},
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
        setMeta(state, meta) 
        {
            state.meta = meta;
        },
    },
    actions: 
    {
        fetchLearningGoals({commit, state, rootState, rootGetters}) 
        {
            return new Promise((resolve, reject) => {
                let url = '/api/learning_goals';
                let data = { user_id: 1 };

                axios({
                    method: 'get',
                    url: url,
                    params: data,
                }).then(response => {
                    commit('setLearningGoals', response.data.data);
                    commit('setMeta', response.data.meta);
                    resolve();
                }).catch(function (error) {
                    reject(error);
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
                    commit('setMeta', response.data.meta);
                    resolve();
                }).catch(function (error) {
                    reject(error);
                });
            });   
        },
        updateLearningGoals({commit, state, rootState, rootGetters}) 
        {
            return new Promise((resolve, reject) => {
                let url = '/api/progress_levels';

                axios({
                    method: 'get',
                    url: url,
                }).then(response => {
                    commit('setProgressLevels', response.data.data);
                    commit('setMeta', response.data.meta);
                    resolve();
                }).catch(function (error) {
                    reject(error);
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
        meta: (state, commit, rootState) => {
            return state.meta;
        }
    }
}