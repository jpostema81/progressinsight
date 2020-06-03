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
    import learningGoalsFilters from '../mixins/learningGoalsFilters';

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
        mixins: [learningGoalsFilters],
        mounted() {
            this.chartPercentages = this.topics.map(
                topic => this.getLearningGoalsTotalProgressByTopicPercentage(topic)
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
        },
        methods: {
 
        },
        computed: {
            ...mapGetters({
                topics: 'LearningGoalsStore/topics',
                learningGoals: 'LearningGoalsStore/learningGoals',
                getProgressPercentageByProgressLevelId: 'LearningGoalsStore/getProgressPercentageByProgressLevelId',
            }),
        },
    }
</script>