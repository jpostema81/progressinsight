<template>
    <div>
        Home
    </div>
</template>

<script>

    export default 
    {
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