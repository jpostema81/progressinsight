export default {
    methods: {
        getLearningGoalsByTopic(topic) {
            return this.learningGoals.filter((learningGoal) => { return learningGoal.topic.id === topic.id });
        },
        // count users LearningGoals which have a ProgressLevel of 100%
        getLearningGoalsTotalProgressPercentage() {
            const reducer = (accumulator, learningGoal) => +accumulator + +this.getProgressPercentageByProgressLevelId(learningGoal.progress_level.id);
            return (this.learningGoals.reduce(reducer, 0) / (this.learningGoals.length * 100) * 100).toFixed();
        },
        // count progress percentages of all users LearningGoals by topic
        getLearningGoalsTotalProgressByTopicPercentage(topic) {
            const reducer = (accumulator, learningGoal) => +accumulator + +this.getProgressPercentageByProgressLevelId(learningGoal.progress_level.id);
            return (this.getLearningGoalsByTopic(topic).reduce(reducer, 0) / (this.getLearningGoalsByTopic(topic).length * 100) * 100).toFixed();
        },
    }
}