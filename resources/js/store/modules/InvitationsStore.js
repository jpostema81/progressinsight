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
            return new Promise((resolve, reject) => {
                let url = `/api/invitations`;

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
        deleteInvitation({ dispatch }, invitationIds) {
            return new Promise((resolve, reject) => {
                let promises = [];

                invitationIds.forEach(invitationId => {
                    promises.push(dispatch('deleteInvitation' , invitationId));
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
            commit('sendInvitationRequest');

            return new Promise((resolve, reject) => { 
                const data = { emails: email.split(',').map(elem => { return { email: elem }}), roles };

                axios({ url: '/api/admin/invitations', data, method: 'POST' }).then(resp => 
                {
                    commit('ErrorsStore/resetErrors', null, { root: true });
                    commit('sendInvitationSuccess');

                    resolve(resp);
                })
                .catch(errors => 
                {                    
                    commit('sendInvitationError');
                    reject(errors);
                });
            });
        }, 
        activateInvitation: function({commit}, payload) {
            commit('ErrorsStore/resetErrors', null, { root: true });
            commit('sendInvitationActivationRequest');

            return new Promise((resolve, reject) => { 
                axios({ url: '/api/user_invitations/', data: payload, method: 'POST' }).then(resp => 
                {
                    commit('ErrorsStore/resetErrors', null, { root: true });
                    commit('sendInvitationActivationSuccess');

                    resolve(resp);
                })
                .catch(errors => 
                {                    
                    commit('sendInvitationActivationError');
                    reject(errors);
                });
            });
        },      
    },
    getters: 
    {
        getInvitationById: (state) => (userId) => {
            return state.users.find(item => item.id == userId);
        },
    },
}