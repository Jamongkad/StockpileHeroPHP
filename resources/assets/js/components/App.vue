<template>
    <div id="app">
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: "Apple Pen", 
            } 
        },
        computed: { 
        },
        methods: {
        },
        ready() {
            //console.log('Component ready.')
        }
    }
</script>
