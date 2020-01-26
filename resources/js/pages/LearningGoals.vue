<template>
    <div>
        LearningGoals page

        <div v-for="learningGoal in learningGoals" :key="learningGoal.id">
            {{ learningGoal }}
            <b-form-select v-model="selected" :options="options"></b-form-select>
        </div>

        <b-button @click="testCall()">test</b-button>
    </div>
</template>

<script>
    import { mapGetters } from "vuex";

    export default 
    {
        // data() {
        //     return {
        //     }
        // },
        mounted() {
            this.$store.dispatch('LearningGoalsStore/fetchLearningGoals');
        },
        // components: 
        // {
            
        // },
        methods: {   
            testCall() {
                this.$store.dispatch('LearningGoalsStore/fetchLearningGoals');
            }     
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
            ...mapGetters({
                learningGoals: 'LearningGoalsStore/learningGoals',
                // meta: 'LearningGoalsStore/meta'
            }),
        },
    }
</script>