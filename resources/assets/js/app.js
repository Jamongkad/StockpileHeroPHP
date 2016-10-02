
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */
import App from './components/App.vue'
import ProductsTable from './components/ProductsTable.vue'
import ProductForm from './components/ProductForm.vue'

import Example from './components/Example.vue'
import VueRouter from 'vue-router'
import VueValidator from 'vue-validator'

Vue.use(VueRouter);
Vue.use(VueValidator);

var router = new VueRouter({
    hashbang: false,
    history: false,
    linkActiveClass: 'active-select'
})

var Bar = Vue.extend({
    template: '<p>This is bar!</p>'
})

router.map({
  '/products': {
      component: ProductsTable
  },
  '/productform': {
      component: ProductForm
  },
  '/product/:id': {
      component: ProductForm
  },
  '/bar': {  
      component: Example
  }
})

router.redirect({
    '*': '/products'
})

router.start({
    components: { App }
}, 'body');
