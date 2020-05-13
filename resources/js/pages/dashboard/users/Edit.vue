<template>
    <div>
        <h3>Gebruiker ... bewerken</h3>

        <user-form></user-form>
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
            }
        },
        components: { UserForm },
        computed: {
            user() {
                const user = this.$store.getters['UsersStore/getUserById'](this.$route.params.id);

                this.userData = JSON.parse(JSON.stringify(user));

                return user;
            },
        },
        methods: {
  
        },
        computed: {
            // ...mapState('UserStore', {
                // users: state => state.users,
                // status: state => state.status,
                // errors: state => state.errors,
            // })
        },
    }
</script>