<template>
    <b-form>
        <b-card class="mb-2">
            <h3>Gegevens</h3>
            <b-form-group label-cols-sm="3" label="Voornaam">
                <b-form-input v-model="data.first_name" />
                <base-form-error :error="errors.first_name ? errors.first_name[0] : ''" />
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Achternaam">
                <b-form-input v-model="data.last_name" />
                <base-form-error :error="errors.last_name ? errors.last_name[0] : ''" />
            </b-form-group>
            <b-form-group label-cols-sm="3" label="E-mailadres">
                <b-form-input v-model="data.email" />
                <base-form-error :error="errors.email ? errors.email[0] : ''" />
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Klant">
                <b-form-select v-model="data.company_id" :options="companies" value-field="id" text-field="name">
                    <template v-slot:first>
                        <option :value="null" disabled>Kies een klant</option>
                    </template>
                </b-form-select>
                <base-form-error :error="errors.company_id ? errors.company_id[0] : ''" />
            </b-form-group>
        </b-card>
        <b-card class="mb-2">
            <h3>Gebruikersrol</h3>
            <b-form-group label-cols-sm="3" label="Gebruikersrol">
                <b-form-select v-model="data.role_id" :options="roles" value-field="id" text-field="name">
                    <template v-slot:first>
                        <option :value="null" disabled>Kies een gebruikersrol</option>
                    </template>
                </b-form-select>
                <base-form-error :error="errors.role_id ? errors.role_id[0] : ''" />
            </b-form-group>
        </b-card>
    </b-form>
</template>

<script>
// import BaseFormError from '../../components/base/FormError';

// import EventBus from '../../eventbus';

export default {
    // components: {BaseFormError},
    // model: {
    //     prop: 'data',
    //     event: 'update',
    // },
    props: {
        data: {
            type: Object,
            required: true,
        },
    },
    computed: {
        // errors() {
        //     return this.$store.getters['errors/getErrors'];
        // },
        // companies() {
        //     return this.$store.getters['companies/getAll'];
        // },
        // roles() {
        //     return this.$store.getters['roles/getAll'];
        // },
    },
    mounted() {
        // this.$store.dispatch('companies/getCompanies');
        // this.$store.dispatch('roles/getRoles');
    },
};
</script>
