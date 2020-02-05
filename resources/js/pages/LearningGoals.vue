<template>
    <div>
        <h2 class="mb-5">LearningGoals</h2>
      
        <b-table v-if="this.learningGoals" hover :items="learningGoals" :fields="fields">
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
              learningGoals: [],
              fields: ['description', 'criterion', 'progressLevel'],
              progressColor: { 'background-color': 'green' },
            }
        },
        mounted() {
            this.$store.dispatch('LearningGoalsStore/fetchProgressLevels');

            this.$store.dispatch('LearningGoalsStore/fetchLearningGoals').then(() => {
                this.learningGoals = this.$store.state.LearningGoalsStore.learningGoals;
            });
        },
        methods: {   
            updateLearningGoals() {
                this.$store.dispatch('LearningGoalsStore/updateLearningGoals', this.learningGoals);
            },
        },
        computed: {
            ...mapGetters({
                progressLevels: 'LearningGoalsStore/progressLevels',
            }),
        },
    }
</script>