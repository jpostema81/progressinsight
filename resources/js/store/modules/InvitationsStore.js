import MessageBus from '../../messageBus';


export const InvitationsStore = {
    namespaced: true,
    state: 
    {
        invitations: [],
        status: '',
    },
    mutations: 
    {
        setInvitations(state, invitations) 
        {
            state.invitations = invitations;
        },
       
        removeInvitation: (state, invitationId)  =>
        {
            state.invitations = state.invitations.filter(item => item.id != invitationId)
        },

        // send invitation state
        sendInvitationRequest: (state) => {
            state.status = 'sending';
        },
        sendInvitationSuccess: (state) => {
            state.status = 'success';
        },
        sendInvitationError: (state) => {
            state.status = 'error';
        },

        // send invitation activation request state
        sendInvitationActivationRequest: (state) => {
            state.status = 'sending';
        },
        sendInvitationActivationSuccess: (state) => {
            state.status = 'success';
        },
        sendInvitationActivationError: (state) => {
            state.status = 'error';
        },
    },
    actions: 
    {
        fetchInvitations({commit}) 
        {
            let url = `/api/admin/invitations`;

            return axios({
                method: 'get',
                url: url,
            }).then(response => {
                commit('setInvitations', response.data.data);
            }).catch(function (errors) {
                return Promise.reject(errors);
            });
        },
        deleteInvitation({ dispatch }, invitationIds) {
            // refactoren
            return new Promise((resolve, reject) => {
                let promises = [];

                invitationIds.forEach(invitationId => {
                    promises.push(dispatch('deleteInvitation' , invitationId));
                });

                Promise.all(promises).then((values) => {
                    resolve();
                }).catch(function (error) {
                    return Promise.reject(error);
                });
            });
        },
        // invite a new user
        invite: function({commit}, { email, roles }) {
            commit('ErrorsStore/resetErrors', null, { root: true });
            commit('sendInvitationRequest');

            const data = { emails: email.split(',').map(elem => { return { email: elem }}), roles };

            return axios({ url: '/api/admin/invitations', data, method: 'POST' }).then(resp => 
            {
                commit('ErrorsStore/resetErrors', null, { root: true });
                commit('sendInvitationSuccess');
            })
            .catch(errors => 
            {                    
                commit('sendInvitationError');
                return Promise.reject(errors);
            });
        }, 
        activateInvitation: function({commit}, payload) {
            commit('ErrorsStore/resetErrors', null, { root: true });
            commit('sendInvitationActivationRequest');

            return axios({ url: '/api/user_invitations/', data: payload, method: 'POST' }).then(resp => 
            {
                commit('ErrorsStore/resetErrors', null, { root: true });
                commit('sendInvitationActivationSuccess');
            })
            .catch(errors => 
            {                    
                commit('sendInvitationActivationError');
                return Promise.reject(errors);
            });
        },      
    },
    getters: 
    {
        getInvitationById: (state) => (invitationId) => {
            return state.invitations.find(item => item.id == invitationId);
        },
    },
}