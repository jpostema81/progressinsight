<template>
    <div v-if="this.learningGoals && this.topics">
        <h3 class="mb-4">Leerdoelen en persoonlijke voortgang</h3>

        <b-progress :max="progressIndicatorMax" show-progress>
            <b-progress-bar :value="progressIndicatorValue">
                Total progress: {{ progressIndicatorValue.toFixed(0) }}%
            </b-progress-bar>
        </b-progress>

        <b-progress class="mt-2" height="2rem" :max="progressIndicatorMax" show-value>
            <b-progress-bar :value="progressIndicatorValue * (6 / 10)" variant="success">HTML: {{ (progressIndicatorValue * (6 / 10)).toFixed(0) }}%</b-progress-bar>
            <b-progress-bar :value="progressIndicatorValue * (2.5 / 10)" variant="warning">CSS: {{ (progressIndicatorValue * (2.5 / 10)).toFixed(0) }}%</b-progress-bar>
            <b-progress-bar :value="progressIndicatorValue * (1.5 / 10)" variant="danger">JavaScript: {{ (progressIndicatorValue * (1.5 / 10)).toFixed(0) }}%</b-progress-bar>
        </b-progress>

        <div role="tablist">
            <b-card no-body class="my-2" v-for="topic in topics" :key="topic.id">
                <b-card-header header-tag="header" class="p-1" role="tab">
                    <b-button block href="#" v-b-toggle.accordion-1 variant="info">{{ topic.name }}</b-button>
                </b-card-header>
                <b-collapse id="accordion-1" visible accordion="my-accordion" role="tabpanel">
                    <b-card-body>
                        <b-card-text v-if="topic.info">{{ topic.info }}</b-card-text>

                        <b-table class="mt-5" hover :items="getLearningGoalsByTopic(topic)" :fields="fields">
                            <template v-slot:cell(progressLevel)="item" class="align-right">
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
                    </b-card-body>
                </b-collapse>
            </b-card>
        </div>

    </div>
</template>

<script>
    import { mapGetters } from "vuex";

    export default 
    {
        data() {
            return {
                learningGoals: [],
                fields: [
                    { 
                        key: 'description',
                        label: 'Omschrijving',
                    },
                    { 
                        key: 'criterion',
                        label: 'Criterium',
                    },
                    { 
                        key: 'progressLevel',
                        label: 'Beheersing',
                    },
                ],
                progressColor: { 'background-color': 'green' },
            }
        },
        mounted() {
            this.$store.dispatch('LearningGoalsStore/fetchProgressLevels');
            this.$store.dispatch('LearningGoalsStore/fetchTopics');
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
                topics: 'LearningGoalsStore/topics',
                getLearningGoalsByTopic: 'LearningGoalsStore/getLearningGoalsByTopic',
            }),
            progressIndicatorValue() {
                if(this.progressLevels && this.learningGoals) 
                {
                    // get ProgressLevelId where percentage equals 100%
                    let hundredPercentProgressLevel = this.progressLevels.find((progressLevel) => { return progressLevel.percentage == 100; })

                    if(hundredPercentProgressLevel !== null) {
                        // count users LearningGoals which have a ProgressLevel of 100%
                        const hundredPercentProgressLevelLearningGoals = this.learningGoals.filter((learningGoal) => learningGoal.progress_level.id === hundredPercentProgressLevel.id);
                        return ((hundredPercentProgressLevelLearningGoals.length / this.learningGoals.length) * 100);
                    } else {
                        return 0;
                    }
                }
            },
            progressIndicatorMax() {
                return 100;
            },
        },
    }
</script>