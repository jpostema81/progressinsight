<template>
    <div id="myApp" class="container">
        <navigation-bar class="mb-4" fixed="top">ProgressInsight</navigation-bar>

        <router-view></router-view>
    </div>
</template>

<script>
    import NavigationBar from './../components/NavigationBar';

    export default 
    {
        components: 
        {
            NavigationBar,
        },
    }
</script>