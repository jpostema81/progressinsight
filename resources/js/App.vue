<template>
    <div id="myApp" class="container">
        <navigation-bar class="mb-4" fixed="top">ProgressInsight</navigation-bar>

        <router-view/>
    </div>
</template>

<script>
    import { mapGetters, mapMutations } from "vuex";
    import NavigationBar from './components/NavigationBar';

    export default {
        components: {
            NavigationBar,
        },
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


