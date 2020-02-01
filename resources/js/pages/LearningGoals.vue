<template>
    <div>
        <h2>LearningGoals</h2>
      
        <b-table hover :items="learningGoals" :fields="fields">
            <template v-slot:cell(progressLevel)="row">
                <b-form-select 
                  v-model="selected" 
                  :options="progressLevels"
                  value-field="id"
                  text-field="name"></b-form-select>
            </template>
        </b-table>

        <b-button @click="updateLearningGoals()">Update</b-button>
    </div>
</template>

<script>
    import { mapGetters } from "vuex";

    export default 
    {
        data() {
            return {
              fields: ['description', 'criterion', 'progressLevel'],
              selected: 3,
            }
        },
        mounted() {
            this.$store.dispatch('LearningGoalsStore/fetchLearningGoals');
            this.$store.dispatch('LearningGoalsStore/fetchProgressLevels');
        },
        methods: {   
            updateLearningGoals() {
                this.$store.dispatch('LearningGoalsStore/updateLearningGoals');
            },
        },
        computed: {
            ...mapGetters({
                learningGoals: 'LearningGoalsStore/learningGoals',
                progressLevels: 'LearningGoalsStore/progressLevels',
                meta: 'LearningGoalsStore/meta'
            }),
        },
    }
</script>