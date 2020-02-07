<template>
    <div id="myApp" class="container">
        <div id="nav">
            <b-img src="/images/logo3t.png" width="100" height="100" fluid alt="Logo"></b-img>
            <router-link v-if="isAuthenticated" to="/learning_goals">Learning Goals</router-link>
            <router-link v-if="!isAuthenticated" to="/login">Login</router-link>
            <b-link v-if="isAuthenticated" @click="logout">| Logout</b-link>
            <span v-if="isAuthenticated && 0" class="float-right mt-5">Logged in as {{ user.full_name }}</span>
        </div>
        <router-view/>
    </div>
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


