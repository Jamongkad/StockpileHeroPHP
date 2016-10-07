<template>
    <div class="row"> 
        <div class="col-md-12 col-sm-12 col-xs-12">
            <validator name="validation">
                <form id="demo-form2" class="form-horizontal form-label-left" novalidate>
                <input type="hidden" v-model="id" />
                <div class="x_panel">
                    <div class="x_title">
                        <h2>General Information</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br/>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Name <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input v-model="product_name" v-validate:product_name="{ required: true }" class="form-control col-md-7 col-xs-12" type="text">
                                <div class="warning" v-if="$validation.product_name.required">Product name is required.</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea v-model="description" v-validate:description="{ required: true }" class="form-control" rows="3" placeholder=""></textarea>
                                <div class="warning" v-if="$validation.description.required">Description is required.</div>
                            </div>
                        </div> 
                    </div>
                    <div class="x_title">
                        <h2>Pricing and Inventory</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br/>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="barcode">Barcode</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input v-model="barcode" class="form-control col-md-7 col-xs-12" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sku">SKU <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input v-model="sku" v-validate:sku="{ required: true }" class="form-control col-md-7 col-xs-12" type="text">
                                <div class="warning" v-if="$validation.sku.required">SKU is required.</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="initial_inventory">Initial inventory</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input v-model="initial_inventory" class="form-control col-md-7 col-xs-12" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="initial_cost">Initial cost <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input v-model="initial_cost" v-validate:initial_cost="['float', 'required']" class="form-control col-md-7 col-xs-12" type="text">
                                <div class="warning" v-if="$validation.initial_cost.required">Initial cost is required.</div>
                                <div class="warning" v-if="$validation.initial_cost.float">Initial cost should be a number.</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="purchase_price">Purchase price <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input v-model="purchase_price" v-validate:purchase_price="['float', 'required']" class="form-control col-md-7 col-xs-12" type="text">
                                <div class="warning" v-if="$validation.purchase_price.required">Purchase price is required.</div>
                                <div class="warning" v-if="$validation.purchase_price.float">Purchase price should be a number.</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="wholesale_price">Wholesale price <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input v-model="wholesale_price" v-validate:wholesale_price="['float', 'required']" class="form-control col-md-7 col-xs-12" type="text">
                                <div class="warning" v-if="$validation.wholesale_price.required">Wholesale price is required.</div>
                                <div class="warning" v-if="$validation.wholesale_price.float">Wholesale price should be a number.</div>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="retail_price">Retail price <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input v-model="retail_price" v-validate:retail_price="['float', 'required']" class="form-control col-md-7 col-xs-12" type="text">
                                <div class="warning" v-if="$validation.retail_price.required">Retail price is required.</div>
                                <div class="warning" v-if="$validation.retail_price.float">Retail price should be a number.</div>
                            </div>
                        </div>
                        <div class="ln_solid"></div>

                        <loading v-if="deleting" message="Deleting Inventory..."></loading>
                        <loading v-if="saving" message="Saving Inventory..."></loading>
                        <div class="form-group" v-if="$route.params.id"> 
                            <span v-if="$validation.valid">
                                <span class="col-md-3 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success btn-block" @click="submit()">Submit</button>
                                </span>
                                <span class="col-md-3 col-sm-6 col-xs-12">
                                    <button type="submit" class="btn btn-danger btn-block" @click="delete_inventory(id)">Delete</button>
                                </span>
                            </span>
                            <span v-else>
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-danger btn-block" @click="delete_inventory(id)">Delete</button>
                                </div>
                            </span>
                        </div>  
                        <div class="form-group" v-else> 
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-success btn-block" @click="submit()" v-if="$validation.valid">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </validator>
        </div>
    </div>
</template>

<script>
import Loading from './Loading.vue'
export default {
    data() {
        return {
            id: "",
            product_name: "", 
            description: "",
            barcode: "",
            sku: "",
            initial_inventory: "",
            initial_cost: "",
            purchase_price: "",
            wholesale_price: "",
            retail_price: "",
            deleting: false,
            saving: false,
        } 
    },
    components: {
        Loading
    },
    computed: { 
    },
    methods: {
        submit() {
            var params = {
                "id": this.id,
                "product_name": this.product_name,
                "description": this.description,
                "barcode": this.barcode,
                "sku": this.sku,
                "initial_inventory": this.initial_inventory,
                "initial_cost": this.initial_cost,
                "purchase_price": this.purchase_price,
                "wholesale_price": this.wholesale_price,
                "retail_price": this.retail_price,
            };

            this.$http.post('/api/products', params, {
                before: () => {
                    this.saving = true; 
                } 
            }).then((response) => {
                //console.log(response);
                this.saving = false; 
                if(response.data.status == "success") {
                    this.$router.go('/products'); 
                }
            });
        },
        delete_inventory(id) {
            if (window.confirm("Are you sure you want to delete this product?")) { 
                this.$http.delete('/api/delete/' + id, { 
                    before: () => { 
                        this.deleting = true; 
                    } 
                }).then((response) => {
                    this.deleting = false;  
                    if(response.data.status == "success") {
                        this.$router.go('/products'); 
                    }
                });
            }
        }
    },
    ready() {
        if(this.$route.params.id) {
            var id = this.$route.params.id;
            this.$http.get('/api/product/' + id).then((response) => {
                var data = response.data.product;
                //console.log(data);
                this.$set('id', data.id);
                this.$set('product_name', data.product_name);
                this.$set('sku', data.sku);
                this.$set('barcode', data.barcode);
                this.$set('description', data.description);
                this.$set('initial_inventory', data.initial_inventory);
                this.$set('initial_cost', data.initial_cost);
                this.$set('purchase_price', data.purchase_price);
                this.$set('wholesale_price', data.wholesale_price);
                this.$set('retail_price', data.retail_price);
            });
        } 
    },
    validators: {
        float: {
            message: "float check",
            check: function(val) {
                return /^(\d+\.?\d*|\.\d+)$/.test(val);   
            }
        }
    }
}
</script>
