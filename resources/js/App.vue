<template>
    <router-view/>
</template>

<script>
    import { mapGetters, mapMutations } from "vuex";

    export default {
        methods: {        
            ...mapMutations('AuthenticationStore', {
                logout: 'logout' 
            }),
        },
        computed: {
            ...mapGetters({
                isAuthenticated: 'AuthenticationStore/isAuthenticated',
                user: 'AuthenticationStore/user',
            }),
        },
    }
</script>


