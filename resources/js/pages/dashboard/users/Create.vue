<template>
    <div>
        <h3>Nieuwe gebruiker(s) toevoegen</h3>

        
    </div>
</template>

<script>
    import { mapState } from 'vuex';

    export default 
    {
        data() {
            return {
                
            }
        },
        created() {
            // this.$store.dispatch('UsersStore/fetchUsers').then(() => {
            //     this.users = JSON.parse(JSON.stringify(this.$store.state.UsersStore.users));
            // });
        },
        methods: {
            // applyBulkAction() 
            // {
            //     switch(this.bulkAction.selected)
            //     {
            //         case 'delete':
            //         {
            //             Object.filter = (obj, predicate) => Object.fromEntries(Object.entries(obj).filter(predicate));
            //             let filteredMessages = Object.keys(Object.filter(this.selectedItems, ([id, selected]) => selected === true)); 

            //             this.$store.dispatch('DashboardMessageStore/deleteMessages', filteredMessages).then(() => {
            //                 this.$store.dispatch('DashboardMessageStore/fetchMessages');
            //                 this.currentPage = 1;
            //                 this.selectedItems = {};
            //             });
                        
            //         }
            //         case 'edit':
            //         {

                        
            //         }
            //     }
            // },
        },
        computed: {
            // ...mapState('UserStore', {
                // users: state => state.users,
                // status: state => state.status,
                // errors: state => state.errors,
            // })
        },
    }
</script>