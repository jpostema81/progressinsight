<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<!-- This form is used by:
    * dashboard user invite (new user) page
-->

<template>
    <b-form>
        <b-card class="mb-2">
            <h3>Gegevens</h3>

            <b-form-group 
                label-cols-sm="3" 
                label="Emailadres"
                description="Geef een of meerdere emailadressen (komma gescheiden) op om een uitnodiging per email te versturen"
            >
                <b-form-input type="text" v-model="data.email" required name="email" class="form-control" :class="{ 'is-invalid': submitted && errors.hasOwnProperty('email') }" />
                <div v-if="submitted && Object.keys(errors).filter(error => error.startsWith('emails.')).length" class="text-danger">{{ Object.keys(errors).filter(key => key.startsWith('emails')).map(elem => errors[elem]).join() }}</div>
            </b-form-group>

            <b-form-group 
                label-cols-sm="3" 
                label="Rol"
                description="Selecteer welke rollen de uit te nodigen gebruikers toegekend krijgen"
            >
                <multiselect v-model="data.roles" :options="roles" 
                    placeholder="Rollen" 
                    label="name" track-by="id" :multiple="true" :taggable="false">
                </multiselect>
                <div v-if="submitted && errors.hasOwnProperty('roles')" class="text-danger">{{ errors.roles.join(' ') }}</div>
            </b-form-group>
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
        },
    },
    components: {
        Multiselect,
    },
    computed: {
        ...mapState('ErrorsStore', { errors: state => state.errors, }),
        roles() {
            return this.$store.state.RolesStore.roles;
        },
    },
};
</script>
