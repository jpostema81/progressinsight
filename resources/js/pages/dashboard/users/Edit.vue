<template>
    <div>
        <h3 class="mb-4">Gebruiker <i>{{ user.full_name }}</i> bewerken</h3>

        <user-form v-model="userData" :submitted="submitted" :config="config"></user-form>

        <div class="form-group">
            <b-button variant="primary" @click="updateUser" :disabled="status === 'updating'">Bijwerken</b-button>
            <img v-show="status === 'updating'" src="data:image/gif;base64,R0lGODlhEAAQAPIAAP///wAAAMLCwkJCQgAAAGJiYoKCgpKSkiH/C05FVFNDQVBFMi4wAwEAAAAh/hpDcmVhdGVkIHdpdGggYWpheGxvYWQuaW5mbwAh+QQJCgAAACwAAAAAEAAQAAADMwi63P4wyklrE2MIOggZnAdOmGYJRbExwroUmcG2LmDEwnHQLVsYOd2mBzkYDAdKa+dIAAAh+QQJCgAAACwAAAAAEAAQAAADNAi63P5OjCEgG4QMu7DmikRxQlFUYDEZIGBMRVsaqHwctXXf7WEYB4Ag1xjihkMZsiUkKhIAIfkECQoAAAAsAAAAABAAEAAAAzYIujIjK8pByJDMlFYvBoVjHA70GU7xSUJhmKtwHPAKzLO9HMaoKwJZ7Rf8AYPDDzKpZBqfvwQAIfkECQoAAAAsAAAAABAAEAAAAzMIumIlK8oyhpHsnFZfhYumCYUhDAQxRIdhHBGqRoKw0R8DYlJd8z0fMDgsGo/IpHI5TAAAIfkECQoAAAAsAAAAABAAEAAAAzIIunInK0rnZBTwGPNMgQwmdsNgXGJUlIWEuR5oWUIpz8pAEAMe6TwfwyYsGo/IpFKSAAAh+QQJCgAAACwAAAAAEAAQAAADMwi6IMKQORfjdOe82p4wGccc4CEuQradylesojEMBgsUc2G7sDX3lQGBMLAJibufbSlKAAAh+QQJCgAAACwAAAAAEAAQAAADMgi63P7wCRHZnFVdmgHu2nFwlWCI3WGc3TSWhUFGxTAUkGCbtgENBMJAEJsxgMLWzpEAACH5BAkKAAAALAAAAAAQABAAAAMyCLrc/jDKSatlQtScKdceCAjDII7HcQ4EMTCpyrCuUBjCYRgHVtqlAiB1YhiCnlsRkAAAOwAAAAAAAAAAAA==" />
            <b-link @click="$router.go(-1)">Terug</b-link>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    import UserForm from '../../../components/forms/UserForm';

    export default 
    {
        data() {
            return {
               userData: {},
               submitted: false,
               config: {
                    firstName: true,
                    lastName: true,
                    email: true,
                    password: false,
                    roles: true,
                },
            }
        },
        components: { UserForm },
        computed: {
            user() {
                const user = this.$store.getters['UsersStore/getUserById'](this.$route.params.blogPostId);
                this.userData = JSON.parse(JSON.stringify(user));
                return user;
            },
            ...mapState('UsersStore', {
                status: state => state.status,
            })
        },
        methods: {
            updateUser() 
            {
                this.submitted = true;

                this.$store.dispatch('UsersStore/updateUser', this.userData).then(() => 
                {
                    this.$router.push('/dashboard/users/overview');
                });
            },
        },
    }
</script>