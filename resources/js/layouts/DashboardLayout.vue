<style>
    #container-layout {
        padding-left: 350px;
    }
    
    #container-layout.collapsed {
        padding-left: 50px;
    }
</style>

<template>
    <div id="container-layout" :class="[{'collapsed' : collapsed}]">
        <navigation-bar class="mb-4" fixed="top">ProgressInsight</navigation-bar>

        <div class="px-2">
            <router-view />
        </div>

        <sidebar-menu
            :menu="menu"
            :collapsed="collapsed"
            :show-one-child="true"
            @toggle-collapse="onToggleCollapse"
        />
    </div>
    
</template>

<script>
    import { SidebarMenu } from 'vue-sidebar-menu';
    import { isMobile } from 'mobile-device-detect';
    import NavigationBar from './../components/NavigationBar';

    export default 
    {
        data() {
            return {
                collapsed: false,
                collapsed: false,
                menu: [
                    {
                        header: true,
                        title: 'Dashboard Navigation',
                        hiddenOnCollapse: true
                    },
                    // {
                    //     href: '/',
                    //     title: 'View Weblog',
                    //     icon: 'fa fa-home'
                    // },
                    {
                        href: '/dashboard',
                        title: 'Dashboard',
                        icon: 'fa fa-sliders-h'
                    },
                    {
                        title: 'Gebruikers',
                        icon: 'fa fa-file-alt',
                        child: [
                            {
                                href: '/dashboard/users/overview',
                                title: 'Overzicht'
                            },
                            {
                                href: '/dashboard/users/invite',
                                title: 'Nieuwe gebruiker uitnodigen'
                            }
                        ]
                    },
                    {
                        href: '/dashboard/profile',
                        title: 'Profiel',
                        icon: 'fa fa-user'
                    },
                ]
            }
        },
        created() {
            this.collapsed = isMobile; 
        },
        components: 
        {
            // FooterComponent,
            SidebarMenu,
            NavigationBar,
        },
        methods: {
            onToggleCollapse(collapsed) {
                this.collapsed = collapsed
            },
        },
    }
</script>