<template>
    <div>
        <div>
            <h3 class="mb-4">Leerdoelen en persoonlijke voortgang</h3>

            <div role="tablist">
                <b-card no-body class="my-2" v-for="(topic, index) in topics" :key="topic.id">
                    <b-card-header header-tag="header" class="p-1" role="tab">
                        <b-button block href="#" v-b-toggle="'accordion-'+index" :variant="getTopicCardVariant(topic)" v-html="`${topic.name} ${getLearningGoalsTotalProgressByTopicPercentage(topic)}%`"></b-button>
                    </b-card-header>
                    <b-collapse :id="'accordion-'+index" visible accordion="my-accordion" role="tabpanel">
                        <b-card-body>
                            <b-card-text v-if="topic.info">{{ topic.info }}</b-card-text>

                            <b-table class="mt-5" hover :items="getLearningGoalsByTopic(topic)" :fields="fields">
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
                                            @change="updateLearningGoals($event, item.item.id)"     
                                        ></b-form-radio-group>
                                    </b-form-group>
                                </template>
                            </b-table>
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
                <b-progress class="mt-2" height="2rem" :max="100" show-value>
                    <b-progress-bar
                        :value="getLearningGoalsTotalProgressPercentage()"
                        :label="`Totale voortgang: ${getLearningGoalsTotalProgressPercentage()}%`"
                        show-progress>
                    </b-progress-bar>
                </b-progress>

                <b-progress class="mt-2" height="2rem" :max="topics.length * 100" show-value>
                    <b-progress-bar
                        v-for="(topic, index) in topics"
                        :key="topic.id"
                        :value="getLearningGoalsTotalProgressByTopicPercentage(topic)"
                        :variant="progressColors[index % progressColors.length]"
                        :label="`${topic.name} ${getLearningGoalsTotalProgressByTopicPercentage(topic)}%`">
                    </b-progress-bar>
                </b-progress>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from "vuex";
    import learningGoalsFilters from '../mixins/learningGoalsFilters';

    export default 
    {
        data() {
            return {
                learningGoals: [],
                fields: [
                    { 
                        key: 'id',
                        label: 'Nr',
                    },
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
        mixins: [learningGoalsFilters],
        created() {
            // fetch learningGoals from store and clone it as otherwise it will change state in VueX outside mutation handlers.
            // Use created instead mounted as mounted is called after DOM is ready and DOM is dependent on learningGoals data being loaded before DOM is loaded
            this.learningGoals = JSON.parse(JSON.stringify(this.$store.state.LearningGoalsStore.learningGoals));
        },
        methods: {   
            updateLearningGoals(progressLevelId, learningGoalId) {
                this.$store.dispatch('LearningGoalsStore/updateUserLearningGoal', { progressLevelId, learningGoalId });
            },
            getTopicCardVariant(topic) {
                return 'info';
            },
        },
        computed: {
            ...mapGetters({
                progressLevels: 'LearningGoalsStore/progressLevels',
                topics: 'LearningGoalsStore/topics',
                getProgressPercentageByProgressLevelId: 'LearningGoalsStore/getProgressPercentageByProgressLevelId',
            }),
        },
    }
</script>