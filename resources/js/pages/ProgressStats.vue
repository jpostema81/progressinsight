<template>
    <div>
        <h3 class="mb-4">Statistieken</h3>

        <div id="chart"></div>

        <b-link @click="$router.go(-1)">Terug</b-link>
    </div>
</template>

<script>
    import { Chart } from 'frappe-charts/dist/frappe-charts.esm.js';
    import { mapGetters } from 'vuex';

    export default {
        data () {
            return {
                chart: {},
                chartTitle: "Uw persoonlijke voortgang per onderwerp",
                chartPercentages: [],
                chartData: {},
                chartColors: [['#4dcd32', '#4dcd32', '#dd0453', '#4dcd32', '#dd0453','#4dcd32', '#4dcd32', '#dd0453', '#4dcd32', '#dd0453']],
            }
        },
        mounted() {
            // repeterend (ook in LearningGoals.vue: refactoren)
            this.$store.dispatch('LearningGoalsStore/fetchProgressLevels').then(() => {
                this.$store.dispatch('LearningGoalsStore/fetchTopics').then(() => {
                    this.$store.dispatch('LearningGoalsStore/fetchLearningGoals').then(() => {
                        this.isBusy = false;
                        this.learningGoals = this.$store.state.LearningGoalsStore.learningGoals;

                        this.chartPercentages = this.topics.map(
                            topic => (this.getCompletedLearningGoalsByTopic(topic).length / this.getLearningGoalsByTopic(topic).length * 100).toFixed()
                        );

                        this.chartData = {
                            labels: this.topics.map(topic => topic.name),
                            datasets: 
                            [
                                { 
                                    values: this.chartPercentages,
                                }
                            ]
                        };

                        this.chart = new Chart("#chart", 
                        {
                            title: this.chartTitle,
                            data: this.chartData,
                            type: 'bar', // or 'bar', 'line', 'scatter', 'pie', 'percentage'
                            height: 400,
                            colors: this.chartColors,
                            tooltipOptions: {
                                formatTooltipY: d => d + '%',
                            },
                        });
                    });
                });
            });
        },
        computed: {
            ...mapGetters({
                progressLevels: 'LearningGoalsStore/progressLevels',
                topics: 'LearningGoalsStore/topics',
                getLearningGoalsByTopic: 'LearningGoalsStore/getLearningGoalsByTopic',
                getCompletedLearningGoals: 'LearningGoalsStore/getCompletedLearningGoals',
                getCompletedLearningGoalsByTopic: 'LearningGoalsStore/getCompletedLearningGoalsByTopic',
            }),
        },
    }
</script>