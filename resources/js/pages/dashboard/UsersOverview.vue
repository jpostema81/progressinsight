<template>
    <div>
        <h3>Gebruikers overzicht</h3>

        test
    </div>
</template>

<script>
    import { mapState } from 'vuex';

    export default 
    {
        data() {
            return {
            }
        },
        created() {
            this.$store.dispatch('UsersStore/fetchUsers').then(() => {
                console.log('Users have been fetched');
            });
            //this.users = JSON.parse(JSON.stringify(this.$store.state.LearningGoalsStore.learningGoals));
        },
        computed: {
            ...mapState('UserStore', {
                users: state => state.users,
                // status: state => state.status,
                // errors: state => state.errors,
            })
        },
    }
</script>