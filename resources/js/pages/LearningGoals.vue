<template>
    <div>
        <h2 class="mb-5">LearningGoals</h2>
      
        <b-table hover :items="learningGoals" :fields="fields">
            <template v-slot:cell(progressLevel)="item">
                <b-form-group>
                    <b-form-radio-group
                        v-model="item.item.progress_level.id"
                        :options="progressLevels"
                        value-field="id"
                        text-field="name"
                        buttons
                        name="radios-btn-default"
                        button-variant="success"
                      ></b-form-radio-group>
                </b-form-group>
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
              progressColor: { 'background-color': 'green' },
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