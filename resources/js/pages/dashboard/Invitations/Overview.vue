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

        <b-table class="mt-5" hover :items="users" :fields="fields">
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
                <b-button size="sm" @click="editUser(row.item)" class="mr-1">
                    Bewerk
                </b-button>

                <b-button size="sm" @click="deleteUser(row.item)" class="mr-1">
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
                users: [],
                selectAll: false,
                selectedItems: [],
                fields: [
                    { 
                        key: 'select', 
                        label: '', 
                    },
                    { 
                        key: 'full_name',
                        sortable: true,
                        label: 'Naam',
                    },
                    { 
                        key: 'email',
                        sortable: true,
                        label: 'Email',
                    },
                    { 
                        key: 'roles',
                        sortable: true,
                        label: 'Rollen',
                        formatter: (value) => {
                            return value.map(a => a.name).join(', ');
                        },
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
            this.$store.dispatch('UsersStore/fetchUsers').then(() => {
                this.fetchUsersFromStore();
            });
            this.$store.dispatch('RolesStore/fetchRoles');
        },
        methods: {
            fetchUsersFromStore() {
                this.users = JSON.parse(JSON.stringify(this.$store.state.UsersStore.users));
            },
            toggleSelectAll()
            {
                this.selectAll = !this.selectAll;

                this.users.forEach(element => {
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
                        let filteredUsers = Object.keys(Object.filter(this.selectedItems, ([id, selected]) => selected === true)); 

                        this.$store.dispatch('UsersStore/deleteUsers', filteredUsers).then(() => {
                            this.fetchUsersFromStore();
                            // this.currentPage  = 1;
                            this.selectedItems = [];
                        });
                    }
                }
            },
            editUser(item) {
                this.$router.push(`/dashboard/users/${item.id}/edit`);
            },
            deleteUser(item) {
                this.$store.dispatch('UsersStore/deleteUser', item.id).then(() => {
                    this.fetchUsersFromStore();
                    // this.currentPage = 1;
                });
            },
        },
    }
</script>