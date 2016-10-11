<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        <authorized-clients></authorized-clients>
                        <clients></clients>
                        <personal-access-tokens></personal-access-tokens>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AuthorizedClients from './passport/AuthorizedClients.vue'
import Clients from './passport/Clients.vue'
import PersonalAccessTokens from './passport/PersonalAccessTokens.vue'

export default {
    data() {
        return {
            name: "Apple Pen", 
        } 
    },
    components: {
        AuthorizedClients,
        Clients,
        PersonalAccessTokens
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
