<template>
    <div>
        <b-navbar fixed="top" toggleable="lg" type="dark" variant="primary" id="navigationBar">
            <b-navbar-brand href="#">
                <slot></slot>
            </b-navbar-brand>

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" is-nav>
                <!-- <b-navbar-nav v-if="isAuthenticated">
                    <b-nav-item to="/learning_goals">Learning Goals</b-nav-item>
                </b-navbar-nav> -->

                <b-navbar-nav class="ml-auto">
                    <b-nav-item v-if="!isAuthenticated" to="/login">
                        Inloggen
                    </b-nav-item>
                    <b-nav-item v-if="!isAuthenticated" to="/register">Registreren</b-nav-item>

                    <b-nav-item-dropdown v-if="isAuthenticated" right>
                        <template v-slot:button-content>
                            <em>{{ user.full_name }}</em>
                        </template>
                        
                        <!-- <b-dropdown-item to="/dashboard">Dashboard</b-dropdown-item> -->
                        <b-dropdown-item to="/dashboard/profile">Profiel</b-dropdown-item>
                        <b-dropdown-item @click="logout">Uitloggen</b-dropdown-item>
                    </b-nav-item-dropdown>
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>
    </div>
</template>

<script>
    import { mapMutations, mapGetters } from 'vuex';

    export default 
    {
        data() {
            return {
                sticky: true,
            }
        },
        methods: 
        {
            ...mapMutations('AuthenticationStore', {
                logout: 'logout' 
            }),
        },
        computed: {
            ...mapGetters({
                isAuthenticated: 'AuthenticationStore/isAuthenticated',
                user: 'AuthenticationStore/user',
            }),
        }
    }
</script>