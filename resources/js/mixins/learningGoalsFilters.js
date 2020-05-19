export default {
    methods: {
        getLearningGoalsByTopic(topic) {
            return this.learningGoals.filter((learningGoal) => { return learningGoal.topic.id === topic.id });
        },
        // count users LearningGoals which have a ProgressLevel of 100%
        getCompletedLearningGoals() {
            return this.learningGoals.filter((learningGoal) => learningGoal.progress_level.id === this.hundredPercentProgressLevel.id);
        },
        // count users LearningGoals by topic which have a ProgressLevel of 100%
        getCompletedLearningGoalsByTopic(topic) {
            return this.getLearningGoalsByTopic(topic).filter((learningGoal) => learningGoal.progress_level.id === this.hundredPercentProgressLevel.id);
        },
    }
}