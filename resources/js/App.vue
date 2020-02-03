<template>
  <div id="myApp" class="container">
    <div id="nav">
      <router-link to="/learning_goals">Learning Goals</router-link> |
      <router-link to="/login">Login</router-link>
    </div>
    <router-view/>
  </div>
</template>

<script>
  export default {
    data() {
            return {
               
            }
        },
        mounted() {
            //this.$store.dispatch('MessageStore/fetchMessages');
        },
        components: 
        {
            
        },
        methods: {        
            // updateKeyword: function(keyword) 
            // {
            //     this.$store.commit('MessageStore/setKeyword', keyword);
            //     this.$store.dispatch('MessageStore/fetchMessages');
            // },
            // loadPage(pageNumber)
            // {
            //     this.$store.dispatch('MessageStore/fetchMessages', pageNumber);
            // },
        },
        computed: {
            // ...mapState('MessageStore', {
            //     keyword: state => state.filter.keyWord,
            // }),
            // ...mapGetters({
            //     messages: 'MessageStore/messages',
            //     meta: 'MessageStore/meta'
            // }),
        },
        watch: {
            // value: function(val) {
            //     this.$store.commit('MessageStore/setSelectedCategories', val);
            //     this.$store.dispatch('MessageStore/fetchMessages');
            // },
        }
  }
</script>


