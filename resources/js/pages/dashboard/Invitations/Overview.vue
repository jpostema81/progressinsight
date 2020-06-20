<template>
    <div>
        <h3>Uitnodigingenoverzicht</h3>

        <b-form inline>
            <!-- <b-pagination
                v-model="currentPage"
                :total-rows="meta.total"
                :per-page="meta.per_page"
                aria-controls="my-table"
                first-text="First"
                prev-text="Prev"
                next-text="Next"
                last-text="Last"
                @change="loadPage"
                class="mt-3 mx-1"
            ></b-pagination> -->

            <b-form-select class="mx-1" v-model="bulkAction.selected" :options="bulkAction.options"></b-form-select>
            
            <b-button class="mx-1" variant="outline-primary" type="button" @click="applyBulkAction">Toepassen</b-button>
        </b-form>

        <b-table class="mt-5" hover :items="invitations" :fields="fields">
            <template v-slot:head(select)="data">
                <b-form-checkbox
                    id="checkboxSelectAll"
                    v-model="selectAll"
                    name="checkboxSelectAll"
                    @change="toggleSelectAll"
                ></b-form-checkbox>
            </template>

            <template v-slot:cell(select)="row">
                <b-form-checkbox
                    :id="'checkbox-'+row.item.id"
                    v-model="selectedItems[row.item.id]"
                    :name="'checkbox-'+row.item.id"
                    @change="selectAll=false"
                ></b-form-checkbox>
            </template>

            <template v-slot:cell(actions)="row">
                <b-button size="sm" @click="editInvitation(row.item)" class="mr-1">
                    Bewerk
                </b-button>

                <b-button size="sm" @click="deleteInvitation(row.item)" class="mr-1">
                    Verwijder
                </b-button>
            </template>
        </b-table>
    </div>
</template>

<script>
    export default 
    {
        data() {
            return {
                bulkAction: {
                    selected: null,
                    options: [
                        { value: null, text: 'Bulk acties' },
                        { value: 'delete', text: 'Verwijder' },
                    ]
                },
                invitations: [],
                selectAll: false,
                selectedItems: [],
                fields: [
                    { 
                        key: 'select', 
                        label: '', 
                    },
                    { 
                        key: 'email',
                        sortable: true,
                        label: 'Email',
                    },
                    { 
                        key: 'activation_token',
                        sortable: true,
                        label: 'Activatie token',
                    },
                    { 
                        key: 'expiration_date',
                        sortable: true,
                        label: 'Expiratie datum',
                    },
                    {   
                        key: 'created_at',
                        sortable: true,
                        label: 'Aangemaakt op',
                        formatter: (value) => {
                            return moment(value).format('DD-MM-YYYY')
                        },
                    },
                    { 
                        key: 'actions', 
                        label: 'Actie', 
                    }
                ],
            }
        },
        created() {
            // REFACTOREN!
            this.$store.dispatch('InvitationsStore/fetchInvitations').then(() => {
                this.fetchInvitationsFromStore();
            });
        },
        methods: {
            fetchInvitationsFromStore() {
                this.invitations = JSON.parse(JSON.stringify(this.$store.state.InvitationsStore.invitations));
            },
            toggleSelectAll()
            {
                this.selectAll = !this.selectAll;

                this.invitations.forEach(element => {
                    this.selectedItems[element.id] = this.selectAll;  
                });
            },
            applyBulkAction() 
            {
                switch(this.bulkAction.selected)
                {
                    case 'delete':
                    {
                        Object.filter = (obj, predicate) => Object.fromEntries(Object.entries(obj).filter(predicate));
                        let filteredInvitations = Object.keys(Object.filter(this.selectedItems, ([id, selected]) => selected === true)); 

                        this.$store.dispatch('InvitationsStore/deleteInvitations', filteredInvitations).then(() => {
                            this.fetchInvitationsFromStore();
                            // this.currentPage  = 1;
                            this.selectedItems = [];
                        });
                    }
                }
            },
            editUser(item) {
                this.$router.push(`/dashboard/invitations/${item.id}/edit`);
            },
            deleteInvitation(item) {
                this.$store.dispatch('InvitationsStore/deleteInvitation', item.id).then(() => {
                    this.fetchInvitationsFromStore();
                    // this.currentPage = 1;
                });
            },
        },
    }
</script>