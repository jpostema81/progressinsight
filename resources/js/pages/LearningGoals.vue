<template>
    <div>
        <div v-if="isBusy" class="loader">
            <strong>Uw leerdoelen worden geladen...</strong>
            <b-spinner variant="success" label="Spinning"></b-spinner>
        </div>

        <div v-if="!isBusy">
            <h3 class="mb-4">Leerdoelen en persoonlijke voortgang</h3>

            <div role="tablist">
                <b-card no-body class="my-2" v-for="topic in topics" :key="topic.id">
                    <b-card-header header-tag="header" class="p-1" role="tab">
                        <b-button block href="#" v-b-toggle.accordion-1 :variant="getTopicCardVariant(topic)" v-html="getProgressPercentageByTopic(topic, true)"></b-button>
                    </b-card-header>
                    <b-collapse id="accordion-1" visible accordion="my-accordion" role="tabpanel">
                        <b-card-body>
                            <b-card-text v-if="topic.info">{{ topic.info }}</b-card-text>

                            <b-table class="mt-5" hover :items="getLearningGoalsByTopic(topic)" :fields="fields" :busy="isBusy">
                                <template v-slot:table-busy>
                                    <div class="text-center text-danger my-2">
                                    <b-spinner class="align-middle"></b-spinner>
                                    <strong>Laden...</strong>
                                    </div>
                                </template>
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

            <b-tooltip target="progressBars" triggers="hover">
                <p class="mt-2">Onderstaande balken geven jouw persoonlijke voortgang weer:</p>

                <ul>
                    <li>bovenste balk: je totale voortang (van alle leerdoelen bij elkaar)</li>
                    <li>onderste blak: voortgang per onderdeel (HTML, CSS, JavaScript, etc.)</li>
                </ul>

                <router-link to="/progress_stats">Klik hier voor een gedetailleerd overzicht</router-link>
            </b-tooltip>

            <div id="progressBars" class="fixed-bottom">
                <b-progress :max="learningGoals.length" show-progress>
                    <b-progress-bar v-if="getCompletedLearningGoals.length > 0" :value="getCompletedLearningGoals.length">
                        Totale voortgang: {{ getCompletedLearningGoals.length }}%
                    </b-progress-bar>
                </b-progress>

                <b-progress class="mt-2" height="2rem" :max="learningGoals.length" show-value>
                    <b-progress-bar v-for="(topic, index) in topics" :key="topic.id" :value="getCompletedLearningGoalsByTopic(topic).length" :variant="progressColors[index % progressColors.length]" v-html="getProgressPercentageByTopic(topic, true)"></b-progress-bar>
                </b-progress>
            </div>
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
                isBusy: true,
                progressColor: { 'background-color': 'green' },
                progressColors: [
                    'success',
                    'info',
                    'warning',
                    'danger',
                    'primary',
                    'secondary',
                    'dark',
                ]
            }
        },
        mounted() {
            // repeterend (ook in ProgressStats.vue: refactoren)
            this.$store.dispatch('LearningGoalsStore/fetchProgressLevels').then(() => {
                this.$store.dispatch('LearningGoalsStore/fetchTopics').then(() => {
                    this.$store.dispatch('LearningGoalsStore/fetchLearningGoals').then(() => {
                        this.isBusy = false;
                        this.learningGoals = this.$store.state.LearningGoalsStore.learningGoals;
                    });
                });
            });
        },
        methods: {   
            updateLearningGoals() {
                this.$store.dispatch('LearningGoalsStore/updateLearningGoals', this.learningGoals);
            },
            getProgressPercentageByTopic(topic, includeTopicName = false) {
                let percentage = (this.getCompletedLearningGoalsByTopic(topic).length / this.getLearningGoalsByTopic(topic).length * 100).toFixed();
                return (includeTopicName) ? `${topic.name} (${percentage}%)` : `(${percentage}%)`;
            },
            getTopicCardVariant(topic) {
                return 'info';
            },
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