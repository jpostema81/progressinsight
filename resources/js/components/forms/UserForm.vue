<template>
    <b-form>
        <b-card class="mb-2">
            <h3>Gegevens</h3>

            <b-form-group label-cols-sm="3" label="Voornaam">
                <b-form-input type="text" v-model="data.first_name" required name="first_name" class="form-control" :class="{ 'is-invalid': submitted && errors.hasOwnProperty('first_name') }" />
                <div v-if="submitted && errors.hasOwnProperty('first_name')" class="invalid-feedback">{{ errors.first_name.join(' ') }}</div>
            </b-form-group>

            <b-form-group label-cols-sm="3" label="Achternaam">
                <input type="text" v-model="data.last_name" required name="last_name" class="form-control" :class="{ 'is-invalid': submitted && errors.hasOwnProperty('last_name') }" />
                <div v-if="submitted && errors.hasOwnProperty('last_name')" class="invalid-feedback">{{ errors.last_name.join(' ') }}</div>
            </b-form-group>

            <b-form-group label-cols-sm="3" label="Emailadres">
                <input type="text" v-model="data.email" required name="email" class="form-control" :class="{ 'is-invalid': submitted && errors.hasOwnProperty('email') }" />
                <div v-if="submitted && errors.hasOwnProperty('email')" class="invalid-feedback">{{ errors.email.join(' ') }}</div>
            </b-form-group>

            <multiselect v-bind:value="value" :options="roles" 
                @input="updateSelectedCategories"
                :placeholder="placeholder" 
                label="name" track-by="id" :multiple="true" :taggable="false">
            </multiselect>
        </b-card>
    </b-form>
</template>

<script>

import { mapState } from 'vuex';
import Multiselect from 'vue-multiselect';

export default {
    model: {
        prop: 'data',
        event: 'update',
    },
    props: {
        data: {
            type: Object,
            required: true,
        },
        submitted: {
            type: Boolean,
            required: true,
        }
    },
    components: {
        Multiselect,
    },
    computed: {
        ...mapState('ErrorsStore', { errors: state => state.errors, }),

        // companies() {
        //     return this.$store.getters['companies/getAll'];
        // },
        roles() {
            return this.$store.state['rolesStore/roles'];
        },
    },
    mounted() {
        // this.$store.dispatch('companies/getCompanies');
        // this.$store.dispatch('roles/getRoles');
    },
};
</script>
