import MessageBus from './../../messageBus';


export const RolesStore = {
    namespaced: true,
    state: 
    {
        roles: [],
    },
    mutations: 
    {
        setRoles: (state, roles) => {
            state.roles = roles;
        },
    },
    actions:
    {
        fetchRoles({commit}) 
        {
            return new Promise((resolve, reject) => {
                let url = `/api/admin/roles`;

                axios({
                    method: 'get',
                    url: url,
                }).then(response => {
                    commit('setRoles', response.data.data);
                    resolve();
                }).catch(function (errors) {
                    MessageBus.$emit('message', {message: 'There was an error while fetching roles', variant: 'danger'}); 
                    commit('ErrorsStore/setErrors', errors);
                    reject(errors);
                });
            });   
        },
    },
}