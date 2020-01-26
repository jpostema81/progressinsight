export const LearningGoalsStore = {
    namespaced: true,
    state: 
    {
        learningGoals: [],
        // meta: [],
        // status: '',
        // errors: {},
    },
    mutations: 
    {
        setLearningGoals(state, learningGoals) 
        {
            state.learningGoals = learningGoals;
        },
        // setMeta(state, meta) 
        // {
        //     state.meta = meta;
        // },
    },
    actions: 
    {
        fetchLearningGoals({commit, state, rootState, rootGetters}, pageNumber = 1) 
        {
            return new Promise((resolve, reject) => {
                let url = '/api/learning_goals';
                // let data = { page: pageNumber };

                // include filters
                // if(state.filter.selectedCategories.length) 
                // {
                //     data.categories = state.filter.selectedCategories.map(a => a.id).join();
                // }

                // if(state.filter.keyWord.length)
                // {
                //     data.keyword = state.filter.keyWord;
                // }

                // if(state.filter.userId)
                // {
                //     data.userId = state.filter.userId;
                // }

                axios({
                    method: 'get',
                    url: url,
                    // params: data,
                }).then(response => {
                    commit('setLearningGoals', response.data.data);
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
        // meta: (state, commit, rootState) => {
        //     return state.meta;
        // }
    }
}