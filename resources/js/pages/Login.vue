<template>
    <div>
        <h3>Login</h3>

        <form @submit.prevent="handleSubmit">
            <div class="form-group">
                <label for="username">Emailadres</label>
                <input type="text" v-model="email" required name="email" class="form-control" :class="{ 'is-invalid': submitted && errors.hasOwnProperty('email') }" />
                <div v-if="submitted && errors.hasOwnProperty('email')" class="invalid-feedback">{{ errors.email.join(' ') }}</div>
            </div>

            <div class="form-group">
                <label htmlFor="password">Wachtwoord</label>
                <input type="password" v-model="password" required name="password" class="form-control" :class="{ 'is-invalid': submitted && errors.hasOwnProperty('password') }" />
                <div v-if="submitted && errors.hasOwnProperty('password')" class="invalid-feedback">{{ errors.password.join(' ') }}</div>
            </div>

            <div class="form-group">
                <button class="btn btn-primary" :disabled="status === 'loading'">Login</button>
                <img v-show="status === 'loading'" src="data:image/gif;base64,R0lGODlhEAAQAPIAAP///wAAAMLCwkJCQgAAAGJiYoKCgpKSkiH/C05FVFNDQVBFMi4wAwEAAAAh/hpDcmVhdGVkIHdpdGggYWpheGxvYWQuaW5mbwAh+QQJCgAAACwAAAAAEAAQAAADMwi63P4wyklrE2MIOggZnAdOmGYJRbExwroUmcG2LmDEwnHQLVsYOd2mBzkYDAdKa+dIAAAh+QQJCgAAACwAAAAAEAAQAAADNAi63P5OjCEgG4QMu7DmikRxQlFUYDEZIGBMRVsaqHwctXXf7WEYB4Ag1xjihkMZsiUkKhIAIfkECQoAAAAsAAAAABAAEAAAAzYIujIjK8pByJDMlFYvBoVjHA70GU7xSUJhmKtwHPAKzLO9HMaoKwJZ7Rf8AYPDDzKpZBqfvwQAIfkECQoAAAAsAAAAABAAEAAAAzMIumIlK8oyhpHsnFZfhYumCYUhDAQxRIdhHBGqRoKw0R8DYlJd8z0fMDgsGo/IpHI5TAAAIfkECQoAAAAsAAAAABAAEAAAAzIIunInK0rnZBTwGPNMgQwmdsNgXGJUlIWEuR5oWUIpz8pAEAMe6TwfwyYsGo/IpFKSAAAh+QQJCgAAACwAAAAAEAAQAAADMwi6IMKQORfjdOe82p4wGccc4CEuQradylesojEMBgsUc2G7sDX3lQGBMLAJibufbSlKAAAh+QQJCgAAACwAAAAAEAAQAAADMgi63P7wCRHZnFVdmgHu2nFwlWCI3WGc3TSWhUFGxTAUkGCbtgENBMJAEJsxgMLWzpEAACH5BAkKAAAALAAAAAAQABAAAAMyCLrc/jDKSatlQtScKdceCAjDII7HcQ4EMTCpyrCuUBjCYRgHVtqlAiB1YhiCnlsRkAAAOwAAAAAAAAAAAA==" />
                <router-link to="/register" class="btn btn-link">Registreren</router-link>
            </div>
        </form>
    </div>
</template>

<script>
    import { mapState, mapMutations } from 'vuex';

    export default 
    {
        data() {
            return {
                email: '',
                password: '',
                submitted: false,
            }
        },
        computed: {
            ...mapState('AuthenticationStore', { status: state => state.status, }),
            ...mapState('ErrorsStore', { errors: state => state.errors, }),
        },
        methods: 
        {
            ...mapMutations('AuthenticationStore', {
                logout: 'logout' 
            }),
            handleSubmit() 
            {
                this.submitted = true;
                const { email, password } = this;

                this.$store.dispatch('AuthenticationStore/login', { email, password }).then(() => 
                {
                    // prefetch all required data that is shared on different pages (LearningGoals page and ProgressStats page)
                    this.$store.dispatch('LearningGoalsStore/fetchProgressLevels').then(() => {
                        this.$store.dispatch('LearningGoalsStore/fetchTopics').then(() => {
                            this.$store.dispatch('LearningGoalsStore/fetchLearningGoals').then(() => {
                                this.$router.push('/learning_goals');
                            });
                        });
                    });
                });
            },
        }
    }
</script>