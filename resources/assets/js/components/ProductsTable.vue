<template>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="col-xs-6 col-md-3">
                        <h2>Inventory</h2>
                    </div>
                    <div class="col-xs-6 col-md-7">
                        <input class="form-control input-sm" 
                          type="search" 
                          placeholder="Search by name or SKU" 
                          v-model="search"
                          v-on:keyup="searchProduct()" />
                    </div>
                    <div class="col-xs-6 col-md-2">
                        <ul class="nav navbar-right panel_toolbox"> 
                            <li><a @click="openAddProduct()"><i class="fa fa-plus-circle"></i> Add Product</a></li>
                        </ul>
                    </div>
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
                            <nav style="margin-top:-32px" class="pull-right">
                                <ul class="pagination">
                                    <li v-if="pagination.current_page > 1">
                                        <a href="#" aria-label="Previous" @click.prevent="changePage(pagination.current_page - 1)">
                                            <span aria-hidden="true">&laquo; prev</span>
                                        </a>
                                    </li>
                                    <li v-if="pagination.current_page < pagination.last_page">
                                        <a href="#" aria-label="Next" @click.prevent="changePage(pagination.current_page + 1)">
                                            <span aria-hidden="true">next &raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
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
                products: [],
                search: "",
                pagination: {
                    current_page: 1     
                },
                intervalTime: 120000,
                searchMode: false,
            } 
        },
        computed: {},
        methods: {
            openAddProduct() {
                this.$router.go('/productform');
            },
            openProduct(id) {
                this.$router.go('/product/' + id);
            },
            loadTable() {                 
                this.fetchProducts();     
            },
            fetchProducts() {
                
                if(this.searchMode) { 
                    var data = { search: this.search, page: this.pagination.current_page };   
                    this.$http.get('/api/search_product', {params: data}).then((response) => {
                        this.products = response.data.data;
                        this.$set('pagination', response.data);
                    });
                } else { 
                    var data = { page: this.pagination.current_page };   
                    this.$http.get('/api/products', {params: data}).then((response) => {
                        this.products = response.data.data;
                        this.$set('pagination', response.data);
                    }); 
                }

            },
            changePage(page) {
                this.pagination.current_page = page;
                this.fetchProducts();     
            },
            searchProduct() {

                if(this.search) {
                    this.searchMode = true;
                    this.pagination.current_page = 0;
                } else {
                    this.searchMode = false; 
                    this.pagination.current_page = 0;
                }

                var data = { search: this.search, page: this.pagination.current_page };   

                this.$http.get('/api/search_product', {params: data}).then((response) => {
                    this.products = response.data.data;
                    this.$set('pagination', response.data);
                });
            },
        },
        ready() { 
            this.loadTable();
            setInterval(() => {
                //update every 2 minute
                console.log("Pineapple Clem");
                this.loadTable();
            }, this.intervalTime);
        },
    }
</script>
