<template>
    <div>
        <h3 class="mb-4">Nieuwe gebruiker(s) uitnodigen</h3>

        <users-invite-form v-model="inviteData" submitted="submitted"></users-invite-form>

        <div class="form-group">
            <b-button variant="primary" @click="inviteNewUser" :disabled="status === 'sending'">Uitnodigen</b-button>
            <img v-show="status === 'sending'" src="data:image/gif;base64,R0lGODlhEAAQAPIAAP///wAAAMLCwkJCQgAAAGJiYoKCgpKSkiH/C05FVFNDQVBFMi4wAwEAAAAh/hpDcmVhdGVkIHdpdGggYWpheGxvYWQuaW5mbwAh+QQJCgAAACwAAAAAEAAQAAADMwi63P4wyklrE2MIOggZnAdOmGYJRbExwroUmcG2LmDEwnHQLVsYOd2mBzkYDAdKa+dIAAAh+QQJCgAAACwAAAAAEAAQAAADNAi63P5OjCEgG4QMu7DmikRxQlFUYDEZIGBMRVsaqHwctXXf7WEYB4Ag1xjihkMZsiUkKhIAIfkECQoAAAAsAAAAABAAEAAAAzYIujIjK8pByJDMlFYvBoVjHA70GU7xSUJhmKtwHPAKzLO9HMaoKwJZ7Rf8AYPDDzKpZBqfvwQAIfkECQoAAAAsAAAAABAAEAAAAzMIumIlK8oyhpHsnFZfhYumCYUhDAQxRIdhHBGqRoKw0R8DYlJd8z0fMDgsGo/IpHI5TAAAIfkECQoAAAAsAAAAABAAEAAAAzIIunInK0rnZBTwGPNMgQwmdsNgXGJUlIWEuR5oWUIpz8pAEAMe6TwfwyYsGo/IpFKSAAAh+QQJCgAAACwAAAAAEAAQAAADMwi6IMKQORfjdOe82p4wGccc4CEuQradylesojEMBgsUc2G7sDX3lQGBMLAJibufbSlKAAAh+QQJCgAAACwAAAAAEAAQAAADMgi63P7wCRHZnFVdmgHu2nFwlWCI3WGc3TSWhUFGxTAUkGCbtgENBMJAEJsxgMLWzpEAACH5BAkKAAAALAAAAAAQABAAAAMyCLrc/jDKSatlQtScKdceCAjDII7HcQ4EMTCpyrCuUBjCYRgHVtqlAiB1YhiCnlsRkAAAOwAAAAAAAAAAAA==" />
            <b-link @click="$router.go(-1)">Terug</b-link>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    import UsersInviteForm from '../../../components/forms/UsersInviteForm';
    import MessageBus from '../../../messageBus';


    export default 
    {
        data() {
            return {
                inviteData: {
                    email: '',
                    roles: [],
                },
                submitted: false,
            }
        },
        components: { UsersInviteForm },
        computed: {
            ...mapState('InvitationsStore', {
                status: state => state.status,
            })
        },
        methods: {
            inviteNewUser() 
            {
                this.submitted = true;

                this.$store.dispatch('InvitationsStore/invite', this.inviteData).then(() => 
                {
                    MessageBus.$emit('message', {message: 'Uitnodigingen zijn succesvol verzonden', variant: 'success'}); 
                    this.$router.push('/dashboard/invitations/overview');
                });
            },
        },
    }
</script>