import MessageBus from './../../messageBus';


export const ErrorsStore = {
    namespaced: true,
    state: 
    {
        errors: {},
    },
    mutations: 
    {
        setErrors: (state, errors) => {
            state.errors = errors;
        },
        resetErrors: (state) => {
            state.errors = {};
        }
    },
    getters: 
    {
        getErrors: (state) => {
            return state.errors;
        },
    }
}