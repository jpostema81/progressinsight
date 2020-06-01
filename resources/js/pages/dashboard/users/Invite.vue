<template>
    <div>
        <h3 class="mb-4">Nieuwe gebruiker(s) uitnodigen</h3>

        <users-invite-form v-model="inviteData" submitted="submitted"></users-invite-form>

        <div class="form-group">
            <b-button variant="primary" @click="inviteNewUser" :disabled="status.updating">Uitnodigen</b-button>
            <img v-show="status === 'updating'" src="data:image/gif;base64,R0lGODlhEAAQAPIAAP///wAAAMLCwkJCQgAAAGJiYoKCgpKSkiH/C05FVFNDQVBFMi4wAwEAAAAh/hpDcmVhdGVkIHdpdGggYWpheGxvYWQuaW5mbwAh+QQJCgAAACwAAAAAEAAQAAADMwi63P4wyklrE2MIOggZnAdOmGYJRbExwroUmcG2LmDEwnHQLVsYOd2mBzkYDAdKa+dIAAAh+QQJCgAAACwAAAAAEAAQAAADNAi63P5OjCEgG4QMu7DmikRxQlFUYDEZIGBMRVsaqHwctXXf7WEYB4Ag1xjihkMZsiUkKhIAIfkECQoAAAAsAAAAABAAEAAAAzYIujIjK8pByJDMlFYvBoVjHA70GU7xSUJhmKtwHPAKzLO9HMaoKwJZ7Rf8AYPDDzKpZBqfvwQAIfkECQoAAAAsAAAAABAAEAAAAzMIumIlK8oyhpHsnFZfhYumCYUhDAQxRIdhHBGqRoKw0R8DYlJd8z0fMDgsGo/IpHI5TAAAIfkECQoAAAAsAAAAABAAEAAAAzIIunInK0rnZBTwGPNMgQwmdsNgXGJUlIWEuR5oWUIpz8pAEAMe6TwfwyYsGo/IpFKSAAAh+QQJCgAAACwAAAAAEAAQAAADMwi6IMKQORfjdOe82p4wGccc4CEuQradylesojEMBgsUc2G7sDX3lQGBMLAJibufbSlKAAAh+QQJCgAAACwAAAAAEAAQAAADMgi63P7wCRHZnFVdmgHu2nFwlWCI3WGc3TSWhUFGxTAUkGCbtgENBMJAEJsxgMLWzpEAACH5BAkKAAAALAAAAAAQABAAAAMyCLrc/jDKSatlQtScKdceCAjDII7HcQ4EMTCpyrCuUBjCYRgHVtqlAiB1YhiCnlsRkAAAOwAAAAAAAAAAAA==" />
            <b-link @click="$router.go(-1)">Terug</b-link>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    import UsersInviteForm from '../../../components/forms/UsersInviteForm';

    export default 
    {
        data() {
            return {
                inviteData: {
                    emailAddresses: '',
                    roles: [],
                },
                submitted: false,
            }
        },
        components: { UsersInviteForm },
        computed: {
            ...mapState('UsersStore', {
                status: state => state.status,
            })
        },
        methods: {
            inviteNewUser() 
            {
                this.submitted = true;

                this.$store.dispatch('InvitesStore/invite', this.userData).then(() => 
                {
                    this.$router.push('/dashboard/invites/overview');
                });
            },
        },
    }
</script>