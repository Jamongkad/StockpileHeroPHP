<template>
    <div class="fadeMe">  
        <div style="top:50%;left:50%;position:absolute">
            <h1 style="text-align:center;">{{ message }}</h1>
            <pulse-loader color="#5F9F9F" size="20px"></pulse-loader>
        </div>
    </div>
</template>

<script>
import { PulseLoader } from 'vue-spinner/dist/vue-spinner.min.js'
export default {
    data() {
        return {
            name: "Apple Pen", 
        } 
    },
    components: {
       PulseLoader     
    },
    computed: {},
    props: ['message'],
    methods: {
    },
    ready() {
        //console.log('Component ready.')
    }
}
</script>
