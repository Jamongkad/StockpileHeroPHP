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
                                            rowspan="1" 
                                            colspan="1" 
                                            style="width: 124px; cursor: pointer"  
                                            @click="orderBy('orderName')" 
                                            > 
                                            <span v-if="filterIcons.orderName.active">
                                                <i v-if="filterIcons.orderName.filter" class="fa fa-sort-amount-asc"></i> 
                                                <i v-else class="fa fa-sort-amount-desc"></i>   
                                            </span>
                                            <span v-else>
                                                <i class="fa fa-sort-amount-asc disable-icon"></i> 
                                            </span>
                                            Name</th>

                                        <th class="sorting" tabindex="0" 
                                            aria-controls="datatable" 
                                            rowspan="1" 
                                            colspan="1" 
                                            style="width: 206px; cursor: pointer" 
                                            @click="orderBy('orderStock')" 
                                            > 
                                            <span v-if="filterIcons.orderStock.active">
                                                <i v-if="filterIcons.orderStock.filter" class="fa fa-sort-amount-asc"></i> 
                                                <i v-else class="fa fa-sort-amount-desc"></i>   
                                            </span>
                                            <span v-else>
                                                <i class="fa fa-sort-amount-asc disable-icon"></i> 
                                            </span>
                                            Total Stock</th>                                  
                                        <th class="sorting" tabindex="0" 
                                            aria-controls="datatable" 
                                            rowspan="1" 
                                            colspan="1" 
                                            style="width: 89px; cursor: pointer" 
                                            @click="orderBy('orderAllocated')" 
                                            > 
                                            <span v-if="filterIcons.orderAllocated.active">
                                                <i v-if="filterIcons.orderAllocated.filter" class="fa fa-sort-amount-asc"></i> 
                                                <i v-else class="fa fa-sort-amount-desc"></i>   
                                            </span>
                                            <span v-else>
                                                <i class="fa fa-sort-amount-asc disable-icon"></i> 
                                            </span>
                                            Allocated</th>
                                        <th class="sorting" tabindex="0" 
                                            aria-controls="datatable" 
                                            rowspan="1" 
                                            colspan="1" 
                                            style="width: 42px; cursor: pointer" 
                                            @click="orderBy('orderAvailable')" 
                                            > 
                                            <span v-if="filterIcons.orderAvailable.active">
                                                <i v-if="filterIcons.orderAvailable.filter" class="fa fa-sort-amount-asc"></i> 
                                                <i v-else class="fa fa-sort-amount-desc"></i>   
                                            </span>
                                            <span v-else>
                                                <i class="fa fa-sort-amount-asc disable-icon"></i> 
                                            </span>
                                            Available</th>
                                        <th class="sorting" tabindex="0" 
                                            aria-controls="datatable" 
                                            rowspan="1" 
                                            colspan="1" 
                                            style="width: 89px; cursor: pointer"  
                                            @click="orderBy('orderCost')" 
                                            > 
                                            <span v-if="filterIcons.orderCost.active">
                                                <i v-if="filterIcons.orderCost.filter" class="fa fa-sort-amount-asc"></i> 
                                                <i v-else class="fa fa-sort-amount-desc"></i>   
                                            </span>
                                            <span v-else>
                                                <i class="fa fa-sort-amount-asc disable-icon"></i> 
                                            </span>
                                            Cost</th>
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
                apiToken: window.apiToken,
                pagination: {
                    current_page: 1     
                },
                intervalTime: 120000,
                searchMode: false,
                orderType: "",
                choiceFilter: "",
                filterIcons: { 
                    orderName: {
                        active: false,
                        filter: false
                    },
                    orderStock: { 
                        active: false,
                        filter: false
                    },
                    orderAllocated: { 
                        active: false,
                        filter: false
                    },
                    orderAvailable: { 
                        active: false,
                        filter: false
                    },
                    orderCost: {
                        active: false,
                        filter: false 
                    },
                }
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

                console.log("Order Type: " + this.orderType);
                console.log("Filter Type: " + this.choiceFilter);
                
                if(this.searchMode) { 
                    console.log("Search Mode on");
                    var data = { search: this.search, page: this.pagination.current_page };   

                    if(this.orderType) {  
                        data = { search: this.search, page: this.pagination.current_page, order_type: this.orderType, order_filter: this.choiceFilter };   
                    }

                    this.loadDataSearchProducts(data);
                } else { 
                    console.log("Normal Mode on");

                    var data = { page: this.pagination.current_page };   

                    if(this.orderType) {  
                        data = { page: this.pagination.current_page, order_type: this.orderType, order_filter: this.choiceFilter };   
                    }
                        
                    this.loadDataProducts(data);
                }

            },
            changePage(page) {
                this.pagination.current_page = page;
                this.fetchProducts();     
            },
            searchProduct() {

                if(this.search) {
                    this.searchMode = true;
                } else {
                    this.searchMode = false;  
                }
                 
                this.pagination.current_page = 0;

                var data = { search: this.search, page: this.pagination.current_page };   
                this.loadDataSearchProducts(data);
            },
            orderBy(icon) {
                this.pagination.current_page = 0;

                for(var prop in this.filterIcons) { 

                    var choice     = this.filterIcons[icon];
                    var otherProps = this.filterIcons[prop];

                    if(otherProps != choice) {
                        otherProps.active = false;      
                        otherProps.filter = false;      
                    } else {
                        choice.active = true ;
                        choice.filter =! choice.filter;
                    }
                } 

                this.orderType = icon;
                this.choiceFilter = choice.filter;

                if(this.searchMode) { 
                    var data = { search: this.search, page: 0, order_type: this.orderType, order_filter: this.choiceFilter };   
                    this.loadDataSearchProducts(data);
                } else { 
                    var data = { page: 0, order_type: icon, order_filter: choice.filter };   
                    this.loadDataProducts(data);
                }

            },
            loadDataProducts(data) {
                data.api_token = this.apiToken;
                this.$http.get('/api/products', {params: data}).then((response) => {
                    this.products = response.data.data;
                    this.$set('pagination', response.data);
                }); 
            },
            loadDataSearchProducts(data) { 
                data.api_token = this.apiToken;
                this.$http.get('/api/search_product', {params: data}).then((response) => {
                    this.products = response.data.data;
                    this.$set('pagination', response.data);
                });
            }
        },
        ready() { 
            this.loadTable();
            /*
            setInterval(() => {
                //update every 2 minute
                console.log("Pineapple Clem");
                this.loadTable();
            }, this.intervalTime);
            */
        },
    }
</script>
