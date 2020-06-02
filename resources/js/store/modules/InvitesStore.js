import MessageBus from './../../messageBus';
import router from '../../router/index';


export const InvitesStore = {
    namespaced: true,
    state: 
    {
        invites: [],
        status: '',
    },
    mutations: 
    {
        setInvites(state, invites) 
        {
            state.invites = invites;
        },
       
        // removeInvite mutations
        removeInvite: (state, inviteId)  =>
        {
            state.invites = state.invites.filter(item => item.id != inviteId)
        },

        // send invite state
        sendInviteRequest: (state) => {
            state.status = 'registering';
        },
        sendInviteSuccess: (state) => {
            state.status = 'success';
        },
        sendInviteError: (state) => {
            state.status = 'error';
        },
    },
    actions: 
    {
        fetchInvites({commit}) 
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
                    commit('ErrorsStore/setErrors', errors, { root: true });
                    reject(errors);
                });
            });   
        },
        deleteInvite({ dispatch }, inviteIds) {
            return new Promise((resolve, reject) => {
                let promises = [];

                inviteIds.forEach(inviteId => {
                    promises.push(dispatch('deleteInvite' , inviteId));
                });

                Promise.all(promises).then((values) => {
                    resolve();
                }).catch(function (error) {
                    reject(error);
                });
            });
        },
        // invite a new user
        invite: function({commit}, { email, roles }) {
            commit('ErrorsStore/resetErrors', null, { root: true });
            commit('sendInviteRequest');

            return new Promise((resolve, reject) => { 
                const data = { emails: email.split(',').map(elem => { return { email: elem }}), roles };

                axios({ url: '/api/admin/invites', data, method: 'POST' }).then(resp => 
                {
                    commit('ErrorsStore/resetErrors', null, { root: true });
                    commit('sendInviteSuccess');

                    resolve(resp);
                })
                .catch(errors => 
                {                    
                    commit('sendInviteError');
                    reject(errors);
                });
            });
        },       
    },
    getters: 
    {
        getInviteById: (state) => (userId) => {
            return state.users.find(item => item.id == userId);
        },
    },
}