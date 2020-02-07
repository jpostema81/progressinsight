<template>
    <div>
        <h2 class="mb-4">LearningGoals</h2>

        <b-progress v-if="this.learningGoals" :max="progressIndicatorMax" show-progress>
            <b-progress-bar :value="progressIndicatorValue">
                Total progress: {{ progressIndicatorValue.toFixed(0) }}%
            </b-progress-bar>
        </b-progress>

        <b-progress v-if="this.learningGoals" class="mt-2" height="2rem" :max="progressIndicatorMax" show-value>
            <b-progress-bar :value="progressIndicatorValue * (6 / 10)" variant="success">HTML: {{ (progressIndicatorValue * (6 / 10)).toFixed(0) }}%</b-progress-bar>
            <b-progress-bar :value="progressIndicatorValue * (2.5 / 10)" variant="warning">CSS: {{ (progressIndicatorValue * (2.5 / 10)).toFixed(0) }}%</b-progress-bar>
            <b-progress-bar :value="progressIndicatorValue * (1.5 / 10)" variant="danger">JavaScript: {{ (progressIndicatorValue * (1.5 / 10)).toFixed(0) }}%</b-progress-bar>
        </b-progress>

        <b-table v-if="this.learningGoals" class="mt-5" hover :items="learningGoals" :fields="fields">
            <template v-slot:cell(progressLevel)="item">
                <b-form-group>
                    <b-form-radio-group
                        v-model="item.item.progress_level.id"
                        :options="progressLevels"
                        value-field="id"
                        text-field="name"
                        buttons
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
            progressIndicatorValue() {
                // get ProgressLevelId where percentage equals 100%
                let hundredPercentProgressLevel = this.progressLevels.find((progressLevel) => { return progressLevel.percentage == 100; })

                if(hundredPercentProgressLevel !== null) {
                    // count users LearningGoals which have a ProgressLevel of 100%
                    const hundredPercentProgressLevelLearningGoals = this.learningGoals.filter((learningGoal) => learningGoal.progress_level.id === hundredPercentProgressLevel.id);
                    return ((hundredPercentProgressLevelLearningGoals.length / this.learningGoals.length) * 100);
                } else {
                    return 0;
                }
            },
            progressIndicatorMax() {
                return 100;
            },
        },
    }
</script>