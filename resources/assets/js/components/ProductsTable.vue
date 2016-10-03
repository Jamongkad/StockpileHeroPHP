<template>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Products <small>Users</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <!--
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a></li>
                                <li><a href="#">Settings 2</a></li>
                            </ul>
                        </li>
                        -->
                        <!--<li><a href="#" @click="openAddProduct()"> Add Product</a></li>-->
                      
                        <li><a @click="openAddProduct()"><i class="fa fa-plus-circle"></i> Add Product</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="datatable" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" 
                                            aria-controls="datatable" 
                                            rowspan="1" 
                                            colspan="1" 
                                            style="width: 124px;" 
                                            aria-sort="ascending" 
                                            aria-label="Name: activate to sort column descending">Name</th>
                                        <th class="sorting" tabindex="0" 
                                            aria-controls="datatable" 
                                            rowspan="1" 
                                            colspan="1" 
                                            style="width: 206px;" 
                                            aria-label="Position: activate to sort column ascending">Total Stock</th>
                                        <th class="sorting" tabindex="0" 
                                            aria-controls="datatable" 
                                            rowspan="1" 
                                            colspan="1" 
                                            style="width: 89px;" 
                                            aria-label="Office: activate to sort column ascending">Allocated</th>
                                        <th class="sorting" tabindex="0" 
                                            aria-controls="datatable" 
                                            rowspan="1" 
                                            colspan="1" 
                                            style="width: 42px;" 
                                            aria-label="Age: activate to sort column ascending">Available</th>
                                        <th class="sorting" tabindex="0" 
                                            aria-controls="datatable" 
                                            rowspan="1" 
                                            colspan="1" 
                                            style="width: 89px;" aria-label="Start date: activate to sort column ascending">Cost</th>
                                    </tr>
                                </thead>
                                <tbody>    
                                    <tr v-for="p in products" track-by="$index" style="cursor:pointer" @click="openProduct(p.id)"> 
                                        <td class="sorting_1">{{ p.product_name }}</td>
                                        <td>{{ p.initial_inventory }}</td>
                                        <td>{{ p.allocation }}</td>
                                        <td>{{ p.available }}</td>
                                        <td>{{ p.initial_cost }}</td>
                                    </tr>
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { poll } from '../helpers/poll.js';

    export default {
        data() {
            return {
                name: "Apple Pen", 
                products: [],
            } 
        },
        computed: { 
        },
        methods: {
            openAddProduct() {
                this.$router.go('/productform');
            },
            openProduct(id) {
                console.log("Opening Product " + id);
                this.$router.go('/product/' + id);
            },
            loadTable() {
                this.$http.get('/api/products').then((response) => {
                    if(response.data) {
                        this.products = response.data.products;     
                    }  
                }); 
            }
        },
        ready() { 
            this.loadTable();
            //update every 1 minute
            setInterval(() => {
                console.log("Pineapple Clem");
                this.loadTable();
            }, 60000);
        },
    }
</script>
