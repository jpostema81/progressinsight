<template>
    <div>
        <b-card class="mb-2">
            <h3 class="mb-4">Registratie bevestigen</h3>

            <b-alert variant="danger" :show="errors.hasOwnProperty('activationToken')">Het is niet gelukt om uw account te activeren. Controleer of u een geldige activatie-link hebt gebruikt.</b-alert>
        </b-card>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    import MessageBus from '../../messageBus';

    export default 
    {
        created() {
            this.$store.dispatch('UsersStore/activateRegistration', this.$route.params.activationToken).then(() => 
            {
                MessageBus.$emit('message', {message: 'Uw gebruikersaccount is geactiveerd', variant: 'success'}); 
                this.$router.push('/login');
            });
        },
        computed: {
            ...mapState('ErrorsStore', { errors: state => state.errors, }),
        },
    }
</script>